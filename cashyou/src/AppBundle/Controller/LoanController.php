<?php

namespace AppBundle\Controller;

use AppBundle\Entity\RolloverAgreement;
use AppBundle\Entity\User;
use AppBundle\Security\User\ApiUser;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints\NotBlank;
use AppBundle\Entity\LoanApplication;
use AppBundle\Entity\TrackingStatus;
use AppBundle\Form\LoanApplicationType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use AppBundle\Entity\RegistrationStep;

class LoanController extends Controller
{
	public function loanApplicationFormAction($productName = null, $termStep = null, $termDefault = null, $amountStep = null, $amountDefault = null)
	{
		$api = $this->get('app.turnkey.lender.api');

		$termStep = $termStep ?: $this->getParameter('turnkey_lender_default_term_step');
		$termDefault = $termDefault ?: $this->getParameter('turnkey_lender_default_term_value');
		$amountStep = $amountStep ?: $this->getParameter('turnkey_lender_default_amount_step');
		$amountDefault = $amountDefault ?: $this->getParameter('turnkey_lender_default_amount_value');

		$product = $productName ? $api->getCreditProductByName($productName) : $api->getDefaultProduct();
		if (empty($product)) {
			return new Response('');
		}

		$loanApplication = new LoanApplication();
		$loanApplication->setProduct($product['Name']);

		$comingSoonMode = $this->getParameter('coming_soon_mode');

		$form = $this->createForm(LoanApplicationType::class, $loanApplication, [
			'action' => $this->generateUrl($comingSoonMode ? 'app.home' : 'app.loan.application.submit'),
		]);

		return $this->render('loan/application.html.twig', [
			'form' => $form->createView(),

			//term
			'termStep' => $termStep,
			'termDefault' => $termDefault,
			'termMin' => $product['MinTerm'],
			'termMax' => $product['MaxTerm'],
			'termMaxWithDiscount' => $product['MaxTerm'],

			//amount
			'amountStep' => $amountStep,
			'amountDefault' => $amountDefault,
			'amountMin' => $product['MinAmount'],
			'amountMax' => $product['MaxAmount'],
			'amountMaxWithDiscount' => $product['MaxAmount'],
		]);
	}

	public function loanApplication2ProductsFormAction($termStep = null, $termDefault = null, $amountStep = null, $amountDefault = null)
	{
		$api = $this->get('app.turnkey.lender.api');

		$termStep = $termStep ?: $this->getParameter('turnkey_lender_default_term_step');
		$termDefault = $termDefault ?: $this->getParameter('turnkey_lender_default_term_value');
		$amountStep = $amountStep ?: $this->getParameter('turnkey_lender_default_amount_step');
		$amountDefault = $amountDefault ?: $this->getParameter('turnkey_lender_default_amount_value');

		$product1Name = $api->getDefaultProductName();
		$product2Name = $api->getNormalProductName();

		$product1 = $api->getCreditProductByName($product1Name);
		$product2 = $api->getCreditProductByName($product2Name);

		//dump($product1);
		//dump($product2);

		if (empty($product1) || empty($product2)) {
			return new Response('');
		}

		$loanApplication = new LoanApplication();
		$loanApplication->setProduct($product1['Name']);		

		$comingSoonMode = $this->getParameter('coming_soon_mode');

		$form = $this->createForm(LoanApplicationType::class, $loanApplication, [
			'action' => $this->generateUrl($comingSoonMode ? 'app.home' : 'app.loan.application.submit'),
		]);

		return $this->render('loan/application.html.twig', [
			'form' => $form->createView(),

			//term
			'termStep' => $termStep,
			'termDefault' => $termDefault,
			'termMin' => $product1['MinTerm'],
			'termMax' => $product2['MaxTerm'],
			'termMaxWithDiscount' => $product1['MaxTerm'],

			//amount
			'amountStep' => $amountStep,
			'amountDefault' => $amountDefault,
			'amountMin' => $product1['MinAmount'],
			'amountMax' => $product2['MaxAmount'],
			'amountMaxWithDiscount' => $product1['MaxAmount'],
		]);
	}

	public function loanApplicationFormSubmitAction(Request $request, SessionInterface $session)
	{
		$loanApplication = new LoanApplication();

		$form = $this->createForm(LoanApplicationType::class, $loanApplication, [
			'action' => $this->generateUrl('app.loan.application.submit'),
		]);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$session->remove('loanApplication');

			if (!$this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
				$session->set('loanApplication', $loanApplication);

				$this->get('app.tracking.helper')->postBack(new TrackingStatus(TrackingStatus::LEAD));

				return $this->redirectToRoute('app.registration-new', array(
                                            'step' => 'create-an-account'
                                        ));
			}
			
			$repository = $this->getDoctrine()->getRepository(User::class);
			$dbUser = $repository->findOneBy(['login' => $this->getUser()->getUsername()]);
			if(!empty($dbUser)){
				$currentStepId = $dbUser->getCurrentStep();

				if($currentStepId){	
					$repository = $this->getDoctrine()->getRepository(RegistrationStep::class);
					$currentStepObj = $repository->findOneBy(['id' => $currentStepId]);
	            	$currentStepAlias = $currentStepObj->getAlias();            	
					if($currentStepAlias!='finish'){
						$session->set('loanApplication', $loanApplication);
						return $this->redirectToRoute('app.registration-new', array(
	                        'step' => $currentStepAlias
	                    ));
					}
				}
			}			
            
//			$product = $this
//				->get('app.turnkey.lender.api')
//				->getDefaultProduct();
//
//			if (!$product || ($product['Name'] != $loanApplication->getProduct())) {
//				$referer = $request->headers->get('referer');
//
//				return $referer ? $this->redirect($referer) : $this->redirectToRoute('app.home');
//			}

			$activeLoans = $this->get('app.turnkey.lender.api')->getCustomerActiveLoans();

			$user = $this->get('app.turnkey.lender.api')->getCustomerDetails();
			$card = $this->get('app.turnkey.lender.api')->getBankCardDetails();

			if ($user->hasBlankRequiredFields()
			    || empty($card)
			    || empty($card->getCardPan())
			    || empty($card->getCardType())) {

				$this->addFlash('profileTab', 'info');
				$this
					->get('app.alert.helper')
					->addAlert(
						$this->get('translator')->trans('Для получения кредита заполните все недостающие поля')
					)
				;

				return $this->redirectToRoute('app.profile');
			}
			$lastLoan = $this->get('app.turnkey.lender.api')->getCustomerLastLoan();

			if ($lastLoan && $lastLoan->getStatus() == 'Rejected') {
				$loanSinceRejectedLimitDays = $this->getParameter('loan_since_rejected_limit_days');
				$daysSinceRejected = (time() - $lastLoan->getCreationDate()->getTimestamp()) / 86400;
				$daysBeforeNextLoan = $daysSinceRejected > $loanSinceRejectedLimitDays ? 0 : ceil($loanSinceRejectedLimitDays -  $daysSinceRejected);

				if ($daysBeforeNextLoan) {
					$this
						->get('app.alert.helper')
						->addAlert(
							$this->get('translator')->trans('Вы сможете взять следующий кредит через %count% %days%', [
								'%count%' => $daysBeforeNextLoan,
								'%days%' => $this->get('translator')->transChoice('день|дня|дней', $daysBeforeNextLoan)
							])
						)
					;

					return $this->redirectToRoute('app.profile');
				}
			}

			if (!empty($activeLoans)) {
				$this
					->get('app.alert.helper')
					->addAlert(
						$this->get('translator')->trans('Чтобы взять новый кредит, погасите, пожалуйста, предыдущий')
					)
				;

				return $this->redirectToRoute('app.profile');
			}

			return $this->approve($loanApplication, $user, $request, $session);
		}

		$referer = $request
			->headers
			->get('referer');

		return $this->redirect($referer ?: $this->generateUrl('app.home'));
	}

	public function loanRolloverSubmitAction(Request $request, SessionInterface $session)
	{
		if (!$this->getUser() || !($this->getUser() instanceof ApiUser)) {
			return $this->redirectToRoute('app.login');
		}

		$termRollover = intval($request->request->get('termRollover'));
		$loanId = intval($request->request->get('loanId'));

		$session->set('termRollover', $termRollover);

		return $this->redirectToRoute('app.loan.rollover.sign', [
		        'loanId' => $loanId,
            ]);
	}

    public function repayAction($loanId, Request $request)
    {
        
        $api = $this->get('app.turnkey.lender.api');
        $loan = $api->getCustomerLoan(intval($loanId));
        
        if (!$loan) {
            throw $this->createNotFoundException();
        }

        $moneyForm = 
            $this->get('form.factory')->createNamedBuilder('repayMoney')
                ->add('amount', HiddenType::class)
                ->getForm()
            ;

        $bonusesForm = 
            $this->get('form.factory')->createNamedBuilder('repayBonuses')
                ->add('bonuses',HiddenType::class)
                ->getForm()
            ;
        
        $moneyForm->handleRequest($request);
        $bonusesForm->handleRequest($request);
        
        if ($moneyForm->isSubmitted() && $moneyForm->isValid()) {
            $moneyFormData = $moneyForm->getData();
            
            $result = $api->makePaymentUAH(
                $loan->getId(),
                $moneyFormData['amount']
            );
            
            if (!isset($result['Success']) 
                || !$result['Success'] 
                || !isset($result['Data']['TransactionID'])
                || !$result['Data']['TransactionID']) {
                    return $this->redirectToRoute('app.loan.repay.error');
            }

            $result = $api->getTransactionStatus($result['Data']['TransactionID']);
            
            //0 - Successful
            //1 - Failed
            //3 - InProgress
            if (isset($result['Data']['TransactionStatus']) && in_array($result['Data']['TransactionStatus'], [0, 3])) {
                return $this->redirectToRoute('app.loan.repay.thankyou');
            }

            return $this->redirectToRoute('app.loan.repay.error');
        }

        $bonusExchangeRate = $api->getBonusExchangeRate();
        $customerBonuses = $api->getCustomerBonuses();
        $repayBonusesMin = 1;
        $repayBonusesMax = $bonusExchangeRate ? intval($customerBonuses->getBonusesBalance() / $bonusExchangeRate) : 0;

        if ($bonusesForm->isSubmitted() && $bonusesForm->isValid()) {
            $result = $api->makePaymentBonuses(
                $loan->getId(),
                intval($bonusesForm->get('bonuses')->getData()) * $bonusExchangeRate
            );
            
            if (isset($result['Success']) && $result['Success']) {
                return $this->redirectToRoute('app.loan.repay.thankyou');
            }

            return $this->redirectToRoute('app.loan.repay.error');
        }


        return $this->render('loan/repay/repay.html.twig', [
            'loan' => $loan,
            'moneyForm' => $moneyForm->createView(),
            'bonusesForm' => $bonusesForm->createView(),
            'customerBonuses' => $customerBonuses,
            'repayBonusesMin' => $repayBonusesMin,
            'repayBonusesMax' => $repayBonusesMax,
        ]);
    }

	public function rolloverRepayAction($loanId, Request $request)
	{

		$api = $this->get('app.turnkey.lender.api');
		$loan = $api->getCustomerLoan(intval($loanId));

		if (!$loan) {
			throw $this->createNotFoundException();
		}

		if (!$loan->getRolloverRepayAmount()) {
			return $this->redirectToRoute('app.loan.rollover.sign', [
				'loanId' => $loan->getId(),
			]);
		}

		$moneyForm =
			$this->get('form.factory')->createNamedBuilder('repayMoney')
			     ->getForm()
		;

		$moneyForm->handleRequest($request);

		if ($moneyForm->isSubmitted() && $moneyForm->isValid()) {
			$result = $api->makePaymentUAH(
				$loan->getId(),
				$loan->getRolloverRepayAmount()
			);

			if (!isset($result['Success'])
			    || !$result['Success']
			    || !isset($result['Data']['TransactionID'])
			    || !$result['Data']['TransactionID']) {
				return $this->redirectToRoute('app.loan.repay.error');
			}

			$result = $api->getTransactionStatus($result['Data']['TransactionID']);

			//0 - Successful
			//1 - Failed
			//3 - InProgress
			if (isset($result['Data']['TransactionStatus']) && in_array($result['Data']['TransactionStatus'], [0, 3])) {
				$loan = $api->getCustomerLoan(intval($loanId));
				//после погашения деньгами у кредита все равно не списался долг
				if ($loan->getRolloverRepayAmount()) {
					return $this->redirectToRoute('app.loan.repay.error');
				}

				return $this->redirectToRoute('app.loan.rollover.sign', [
					'loanId' => $loan->getId(),
				]);
			}

			return $this->redirectToRoute('app.loan.repay.error');
		}


		$customerBonuses = $api->getCustomerBonuses();
		$bonusExchangeRate = $api->getBonusExchangeRate();

		$bonusesForm = false;

		if ($customerBonuses
		    && $bonusExchangeRate
		    && ($customerBonuses->getBonusesBalance() >= $loan->getRolloverRepayAmount() * $bonusExchangeRate) ) {

			$bonusesForm =
				$this->get('form.factory')->createNamedBuilder('repayBonuses')
				     ->getForm()
			;

			$bonusesForm->handleRequest($request);
		}

		if ($bonusesForm && $bonusesForm->isSubmitted() && $bonusesForm->isValid()) {
			$result = $api->makePaymentBonuses(
				$loan->getId(),
				$loan->getRolloverRepayAmount() * $bonusExchangeRate
			);

			if (isset($result['Success']) && $result['Success']) {
				return $this->redirectToRoute('app.loan.rollover.sign', [
					'loanId' => $loan->getId(),
				]);
			}

			return $this->redirectToRoute('app.loan.repay.error');
		}


		return $this->render('loan/rollover/repay.html.twig', [
			'loan' => $loan,
			'moneyForm' => $moneyForm->createView(),
			'bonusesForm' => $bonusesForm ? $bonusesForm->createView() : false,
		]);
	}

	public function rolloverSignAction($loanId, SessionInterface $session)
	{
		$user = $this->getUser();
		if (!($user instanceof ApiUser)) {
			throw $this->createNotFoundException();
		}

		$api = $this->get('app.turnkey.lender.api');
		$loan = $api->getCustomerLoan(intval($loanId));
		$termRollover = $session->get('termRollover');

		if (!$loan) {
			throw $this->createNotFoundException();
		}

		if (!$termRollover) {
			return $this->redirectToRoute('app.profile');
		}

		if ($loan->getRolloverRepayAmount()) {
			return $this->redirectToRoute('app.loan.rollover.repay', ['loanId' => $loan->getId()]);
		}

		return $this->render('loan/rollover/sign.html.twig', [
			'loanId' => $loan->getId(),
		]);
	}

	public function rolloverAgreementAction($loanId, SessionInterface $session)
	{
		if (!$this->getUser() || !($this->getUser() instanceof ApiUser)) {
			throw $this->createNotFoundException();
		}

		$api = $this->get('app.turnkey.lender.api');
		$user = $api->getCustomerDetails();
		$loan = $api->getCustomerLoan(intval($loanId));
        $expiredDays =  $loan->isExpired() ? -1 * $loan->getDaysUntilNextPayment() : 0;

		if (empty($loan)) {
			throw $this->createNotFoundException();
		}

		$termRollover = $session->get('termRollover');
		if (!$termRollover) {
			throw $this->createNotFoundException();
		}

		$templateContent = $this->getRolloverAgreementTemplate();

		$agreementDocumentId = $this
			->getDoctrine()
			->getRepository(RolloverAgreement::class)
			->nextAgreementId($loan);

		$agreement = new RolloverAgreement($agreementDocumentId, $user, $loan, $termRollover, $expiredDays, $templateContent);

		return $this->renderRolloverAgreement($agreement);
	}

	public function rolloverDocumentAction($loanId, $documentId, $download = true)
	{
		/** @var ApiUser|null $user */
		$user = $this->getUser();
		if ($this->getUser() instanceof ApiUser) {
			$repository = $this->getDoctrine()->getRepository(RolloverAgreement::class);
			/** @var RolloverAgreement $rolloverAgreement */
			$rolloverAgreement = $repository->findOneBy([
				'user.login' => $user->getUsername(),
				'loan.id' => $loanId,
				'documentId' => $documentId,
			]);

			if ($rolloverAgreement) {
				return $this->renderRolloverAgreement($rolloverAgreement, $download);
			}
		}

		throw $this->createNotFoundException();
	}

	public function rolloverSmsSignAction($loanId, Request $request, SessionInterface $session)
	{
		$verifyForm =
			$this->get('form.factory')->createNamedBuilder('verifyForm')
			     ->add('code', TextType::class, [
				     'label' => false,
				     'constraints' => array(
					     new NotBlank(),
				     ),
			     ])
			     ->setAction($this->generateUrl('app.loan.rollover.sign.sms', [
				     'loanId' => $loanId,
			     ]))
			     ->getForm();

		$resendForm =
			$this->get('form.factory')->createNamedBuilder('resendForm')
			     ->setAction($this->generateUrl('app.loan.rollover.sign.sms', [
				     'loanId' => $loanId,
			     ]))
			     ->getForm();

		$api = $this->get('app.turnkey.lender.api');
		$translator = $this->get('translator');
		$smsSignStorage = $this->get('app.sms.sign.storage');

		$verifyForm->handleRequest($request);

		if ($verifyForm->isSubmitted() && $verifyForm->isValid()) {
			$termRollover = $session->get('termRollover');
            $loan = $api->getCustomerLoan(intval($loanId));
            $expiredDays =  $loan->isExpired() ? -1 * $loan->getDaysUntilNextPayment() : 0;
			if (!$termRollover) {
				return new JsonResponse([
					'url' => $this->generateUrl('app.profile'),
				]);
			}

			if ($smsSignStorage->verifyCode($verifyForm->get('code')->getData(), intval($loanId))) {
				$result = $api->requestRollover(intval($loanId), $termRollover + $expiredDays.'d');
				if (!empty($result) && !empty($result['Success'])) {
					try {
						$user = $api->getCustomerDetails();
						$loan = $api->getCustomerLoan(intval($loanId));
						/** @var ApiUser $apiUser */
						$apiUser = $this->getUser();
						$user->setLogin($apiUser->getUsername());

						if (empty($loan)) {
							return new JsonResponse([
								'url' => $this->generateUrl('app.loan.rollover.sign.error'),
							]);
						}

						$templateContent = $this->getRolloverAgreementTemplateForMail();

						$agreementDocumentId = $this
							->getDoctrine()
							->getRepository(RolloverAgreement::class)
							->nextAgreementId($loan);

						$agreement = new RolloverAgreement($agreementDocumentId, $user, $loan, $termRollover, $expiredDays, $templateContent);

						$em = $this->getDoctrine()->getManager();
						$em->persist($agreement);
						$em->flush();

                        $pdf = $this->get( 'white_october.tcpdf' )->create();

                        $pdf->setPrintHeader( false );
                        $pdf->setPrintFooter( false );
                        $pdf->setHeaderMargin( 0 );
                        $pdf->SetMargins( 10, 10, 10 );
                        $pdf->AddPage();
                        $pdf->SetFont( 'dejavusans', '', 12, '', 'false' );

                        $template = $this->get( 'twig' )->createTemplate( $agreement->getPdfTemplate() );
                        $html = $template->render( [ 'agreement' => $agreement ] );
                        $pdf->writeHTML( $html );

                        $message = (new \Swift_Message('Додаткова угода'))
                            ->setFrom('info@cashyou.ua')
                            ->setTo('info@cashyou.ua')
                            ->setBody($html,
                                'text/html'
                            )
                            ->attach(\Swift_Attachment::newInstance($pdf->getPDFData(), 'Угода.pdf','application/pdf'));
                        $mailer = $this->get('swiftmailer.mailer');
                        $mailer->send($message);
					}
					catch (\Exception $e) {
						return new JsonResponse([
							'url' => $this->generateUrl('app.loan.rollover.sign.error'),
						]);
					}

					return new JsonResponse([
						'url' => $this->generateUrl('app.loan.rollover.sign.success'),
					]);
				}

				return new JsonResponse([
					'url' => $this->generateUrl('app.loan.rollover.sign.error'),
				]);
			}

			$verifyForm->get('code')->addError(new FormError($translator->trans('Неправильный код.')));
		}

		$resendForm->handleRequest($request);

		if ($resendForm->isSubmitted() && $resendForm->isValid()) {
			$user = $api->getCustomerDetails();
			if (!$user) {
				return new JsonResponse([
					'url' => $this->generateUrl('app.login'),
				]);
			}

			$code = mt_rand (1000, 9999);
			$smsSignStorage->setVerificationCode($code, intval($loanId));
			$message = $this->get('translator')->trans('Vash kod perevirky: %code%. Cashyou.ua kredyt online. Tel:08002122300', [
				'%code%' => $code,
			]);

			$phone = $user->getPhone();
			$phone = $phone ? preg_replace('|[^\+0-9]|', '', $phone) : $phone;

			$this->get('app.turbosms')->send($message, $phone);

			return new JsonResponse([
				'messages' => [
					[
						'type' => 'success',
						'text' => $translator->trans('СМС было повторно отправлено'),
					],
				]
			]);
		}

		if (!$verifyForm->isSubmitted() && !$resendForm->isSubmitted())
        {
            $user = $api->getCustomerDetails();
            if (!$user) {
                return new JsonResponse([
                    'url' => $this->generateUrl('app.login'),
                ]);
            }

            $code = mt_rand (1000, 9999);
            $smsSignStorage->setVerificationCode($code, intval($loanId));
            $message = $this->get('translator')->trans('Vash kod perevirky: %code%. Cashyou.ua kredyt online. Tel:08002122300', [
                '%code%' => $code,
            ]);

            $phone = $user->getPhone();
            $phone = $phone ? preg_replace('|[^\+0-9]|', '', $phone) : $phone;

            $this->get('app.turbosms')->send($message, $phone);
        }

		return $this->render($request->isXmlHttpRequest() ? 'loan/form-sign.html.twig' : 'loan/sign-popup.html.twig', [
			'verifyForm' => $verifyForm->createView(),
			'resendForm' => $resendForm->createView(),
		]);
	}

    public function agreementAction($loanId, $download = false)
    {
        $api = $this->get('app.turnkey.lender.api');

        $agreementBinary = $api->downloadAgreement(intval($loanId));

        $response = new StreamedResponse(function() use ($agreementBinary) {
            echo $agreementBinary;
        });

        $response->headers->set('Content-Type', 'application/pdf');

        if ($download) {
            $disposition = $response->headers->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                'agreement.pdf'
            );

            $response->headers->set('Content-Disposition', $disposition);
        }
        
        return $response;
    }
    
    public function signAction($loanId)
    {
        $user = $this->getUser();
        if (!($user instanceof ApiUser)) {
	        throw $this->createNotFoundException();
        }

        $api = $this->get('app.turnkey.lender.api');

        $loan = $api->getCustomerLoan(intval($loanId));

	    if (!$loan) {
		    throw $this->createNotFoundException();
	    }

	    $documentsToSign = $loan->getDocumentsToSign();
        
        if (empty($documentsToSign)) {
	        throw $this->createNotFoundException();
        }
        
        return $this->render('loan/sign.html.twig', [
            'loanId' => $loanId,
            'signatureId' => $documentsToSign[0]->getSignatureId(),
        ]);
    }
    
    public function smsSignAction($loanId, $signatureId, Request $request)
    {
        $verifyForm =
            $this->get('form.factory')->createNamedBuilder('verifyForm')
            ->add('code', TextType::class, [
                'label' => false,
                'constraints' => array(
                    new NotBlank(),
                ),
            ])
            ->setAction($this->generateUrl('app.loan.sign.form', [
                'loanId' => $loanId,
                'signatureId' => $signatureId,
            ]))
            ->getForm();
        
        $resendForm =
            $this->get('form.factory')->createNamedBuilder('resendForm')
            ->setAction($this->generateUrl('app.loan.sign.form', [
                'loanId' => $loanId,
                'signatureId' => $signatureId,
            ]))
            ->getForm();

        $api = $this->get('app.turnkey.lender.api');
        $translator = $this->get('translator');
        
        $verifyForm->handleRequest($request);
        
        if ($verifyForm->isSubmitted() && $verifyForm->isValid()) {
            $response = $api->signLoan($loanId, $signatureId, $verifyForm->get('code')->getData());
            
            if (!$response || empty($response['Success'])) {
                $verifyForm->get('code')->addError(new FormError($translator->trans('Неправильный код.')));
            } else {
                $jsonResponse = new JsonResponse([
                    'url' => $this->generateUrl('app.loan.sign.success'),
                ]);
                if($api->isFirstCustomerLoan() && $request->cookies->get('service') == 'salesdoubler')
                {
                    $sd = $this->get('app.tracking.salesdoubler.helper');
                    $sd->postBack($loanId);
                    $html = 'Номер кредита:' . $loanId . '<br>ID клика: ' . $sd->getclickId();
                    $message = (new \Swift_Message('Конверсия от SD'))
                        ->setFrom('info@cashyou.ua')
                        ->setTo('marketing@cashyou.ua')
                        ->setBody($html,
                            'text/html');
                    $mailer = $this->get('swiftmailer.mailer');
                    $mailer->send($message);
                    $jsonResponse->headers->removeCookie('subid');
                    $jsonResponse->headers->removeCookie('service');
                }

                if ($ctsid = $request->cookies->get('ctsid')) {
                    $this->get('app.cashyou.tracker.helper')->track($ctsid, 'action');
                    $jsonResponse->headers->clearCookie('ctsid');
                }

                return $jsonResponse;
            }
        }

        $resendForm->handleRequest($request);
        
        if ($resendForm->isSubmitted() && $resendForm->isValid()) {
            $response = $api->resendSmsCode($loanId, $signatureId);

            if (!$response || empty($response['Success'])) {
                return new JsonResponse([
                    'messages' => [
                        [
                            'type' => 'error',
                            'text' => $translator->trans('Ошибка отправки СМС'),
                        ],
                    ]
                ]);
            } else {
                return new JsonResponse([
                    'messages' => [
                        [
                            'type' => 'success',
                            'text' => $translator->trans('СМС было повторно отправлено'),
                        ],
                    ]
                ]);
            }
        }
        
        return $this->render($request->isXmlHttpRequest() ? 'loan/form-sign.html.twig' : 'loan/sign-popup.html.twig', [
            'verifyForm' => $verifyForm->createView(),
            'resendForm' => $resendForm->createView(),
        ]);
    }

	/**
	 * @return bool|string
	 */
	protected function getRolloverAgreementTemplate() {
		$parser          = $this->container->get( 'templating.name_parser' );
		$locator         = $this->container->get( 'templating.locator' );
		$templatePath    = $locator->locate( $parser->parse( 'pdf/rollover.agreement.html.twig' ) );
		$templateContent = file_get_contents( $templatePath );

		return $templateContent;
	}

    /**
     * @return bool|string
     */
    protected function getRolloverAgreementTemplateForMail() {
        $parser          = $this->container->get( 'templating.name_parser' );
        $locator         = $this->container->get( 'templating.locator' );
        $templatePath    = $locator->locate( $parser->parse( 'pdf/rollover.agreement.mail.html.twig' ) );
        $templateContent = file_get_contents( $templatePath );

        return $templateContent;
    }

	/**
	 * @param RolloverAgreement $agreement
	 * @param bool $download
	 *
	 * @return StreamedResponse
	 * @throws \Exception
	 * @throws \Throwable
	 * @throws \Twig_Error_Loader
	 * @throws \Twig_Error_Syntax
	 */
	protected function renderRolloverAgreement( $agreement, $download = false ) {
		$pdf = $this->get( 'white_october.tcpdf' )->create();

		$pdf->setPrintHeader( false );
		$pdf->setPrintFooter( false );
		$pdf->setHeaderMargin( 0 );
		$pdf->SetMargins( 10, 10, 10 );
		$pdf->AddPage();
		$pdf->SetFont( 'dejavusans', '', 12, '', 'false' );

		$template = $this->get( 'twig' )->createTemplate( $agreement->getPdfTemplate() );

		$html = $template->render( [ 'agreement' => $agreement ] );

		$pdf->writeHTML( $html );

		$response = new StreamedResponse( function () use ( $pdf ) {
			echo $pdf->getPDFData();
		} );

		$response->headers->set( 'Content-Type', 'application/pdf' );

		if ($download) {
			$disposition = $response->headers->makeDisposition(
				ResponseHeaderBag::DISPOSITION_ATTACHMENT,
				sprintf('agreement-%s.pdf', $agreement->getDocumentId())
			);

			$response->headers->set('Content-Disposition', $disposition);
		}

		return $response;
	}

    /**
     * Submit application to TurnKey and RiskTools
     * @param LoanApplication $loanApplication
     * @param User $user
     * @param Request $request
     * @param SessionInterface $session
     * @return RedirectResponse
     */
    protected function submitLoan(LoanApplication $loanApplication, User $user, Request $request, SessionInterface $session)
    {
        $result = $this->get('app.turnkey.lender.api')->applyForLoan($loanApplication);
        if (!empty($result) && !empty($result['Success'])) {
            $response = new RedirectResponse($this->generateUrl('app.pending.approval'), 302);
            $session->remove('loanApplication');
            $session->remove('limitAmount');
            if($request->cookies->get('service') == 'keitaro') {
                $this->get('app.tracking.helper')->postBack(new TrackingStatus(TrackingStatus::SALE));
                $response->headers->removeCookie('subid');
                $response->headers->removeCookie('service');
            }

            if ($ctsid = $request->cookies->get('ctsid')) {
                $this->get('app.cashyou.tracker.helper')->track($ctsid, 'lead');
            }

            return $response;
        }

        return $this->redirectToRoute('app.home');
    }

    /**
     * Try to approve application in RiskTools
     * @param LoanApplication $loanApplication
     * @param User $user
     * @param Request $request
     * @param SessionInterface $session
     * @return RedirectResponse
     */
    protected function approve(LoanApplication $loanApplication, User $user, Request $request, SessionInterface $session)
    {
        try {
            $logger = $this->get('logger');
            $rtClient = $this->get('app.risktools.client');
            //renew previous loan
            $lastLoan = $this->get('app.turnkey.lender.api')->getCustomerLastClosedLoan();
                if ($lastLoan) {
                    try {
                        $total_paid = 0;
                        $closed_at = $lastLoan->getRepayments()->last()->getOperationDate();
                        foreach ($lastLoan->getRepayments() as $repayment) {
                            $total_paid += $repayment->getAmount();
                        }
                        $applicationData = $this->prepareApplicationForRT($loanApplication, $user, $request, [
                            'id' => (string)$lastLoan->getId(),
                            'status_id' => $lastLoan->getStatusRT(),
                            'total_paid' => $total_paid,
                            'overdue_days' => 0,
                            'closed_at' => $closed_at->format('Y-m-d\TH:i:sP'),
                            'amount_to_pay' => 0,
                            'applied_at' => $lastLoan->getCreationDate()->format('Y-m-d\TH:i:sP'),
                        ]);
                        $methodBulk = '/apps/upsert_bulk';
                        $response = $rtClient->exec($methodBulk, [
                            'applications' => [$applicationData]
                        ], false);
                    } catch (Exception $e) {
                        $logger->info('RISK TOOLS CALL', [
                            'method' => $methodBulk,
                            'response' => $e,
                            'parameters' => $applicationData,
                            'url' => $rtClient->url,
                            'key' => $rtClient->key
                        ]);
                    }
                }
            $applicationData = $this->prepareApplicationForRT($loanApplication, $user, $request, [
                'id' => uniqid(),
                'tmp' => 1,
                'applied_at' => date('Y-m-d\TH:i:sP'),
            ]);
            $method = '/scoring/get_score';
            $response = $rtClient->exec($method, [
                'application' => $applicationData
            ], false);

            if($response['amount_limit'] >= $loanApplication->getAmount()) {
                return $this->submitLoan($loanApplication, $user, $request, $session);
            }
            elseif($response['amount_limit'] == 0) {
                $this->addFlash('rejectedLoan', true); //activate popup
                $loanApplication->setAmount(101);

                $productStr = $loanApplication->getProduct();        
      
                if($productStr == 'Initial credit product in 1.8%' 
                	|| $productStr == 'Initial credit product in 0.01%'){                    
                    $loanApplication->setProduct('reject');                            
                } else {
                	$loanApplication->setProduct('reject base');
                }
                
                $result = $this->get('app.turnkey.lender.api')->applyForLoan($loanApplication);
                if (!empty($result) && !empty($result['Success'])) {
                    $response = new RedirectResponse($this->generateUrl('app.profile'), 302);
                    if($request->cookies->get('service') == 'keitaro') {
                        $this->get('app.tracking.helper')->postBack(new TrackingStatus(TrackingStatus::SALE));
                        $response->headers->removeCookie('subid');
                        $response->headers->removeCookie('service');
                    }
                    if ($ctsid = $request->cookies->get('ctsid')) {
                        $this->get('app.cashyou.tracker.helper')->track($ctsid, 'lead');
                    }
                    return $response;
                }
                return $this->redirectToRoute('app.profile');
            }
            elseif($response['amount_limit'] < $loanApplication->getAmount()) {
                $session->set('limitAmount', $response['amount_limit']);
                $session->set('loanApplication', $loanApplication);
                $this->addFlash('rejectedAmount', $loanApplication->getAmount()); //activate popup
                return $this->redirectToRoute('app.profile');
            }
        }
        catch (Exception $e) {
            $logger->info('RISK TOOLS CALL', [
                'method' => $method,
                'response' => $e,
                'parameters' => $applicationData,
                'url' => $rtClient->url,
                'key' => $rtClient->key
            ]);
            return $this->submitLoan($loanApplication, $user, $request, $session);
        }
    }

    /**
     * Submit requests when user apply new amount
     * @param Request $request
     * @param Session $session
     * @return RedirectResponse
     */
    public function applyAmountAction(Request $request, Session $session)
    {
        if($session->has('limitAmount')) {
            $limitAmount = $session->get('limitAmount');
            $loanApplication = $session->get('loanApplication');
            $loanApplication->setAmount($limitAmount);
            $user = $this->get('app.turnkey.lender.api')->getCustomerDetails();
            return $this->submitLoan($loanApplication, $user, $request, $session);
        }
        throw $this->createNotFoundException();
    }

    /**
     * Prepare application data for RiskTools requests
     * @param LoanApplication $loanApplication
     * @param User $user
     * @param Request $request
     * @param array $extended
     * @return array
     */
    protected function prepareApplicationForRT(LoanApplication $loanApplication, User $user, Request $request, array $extended = [])
    {
        return array_merge([
            'user_id' => $this->getUser()->getApiToken(),
            'email' => $user->getEmail(),
            'social_number' => $user->getSocialSecurityNumber(),
            'phone' => $user->getPhone(),
            'passport_number' => str_replace(' ', '', $user->getPassport()),
            'passport_date' => $user->getPassportRegistration()->format('d.m.Y'),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'other_name' => $user->getMiddleName(),
            'birth_date' => $user->getBirthDate()->format('Y-m-d'),
            'gender_id' => $user->getGender()->getValue(),
            'loan_amount' => $loanApplication->getAmount(),
            'loan_days' => $loanApplication->getTerm(),
            'ip' => $request->getClientIp(),
            'user_agent' => $request->headers->get('User-Agent')
        ], $extended);
    }
}