<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BonusesDegree;
use AppBundle\Entity\ImproveLoyalityProgramRequest;
use AppBundle\Entity\Loan;
use AppBundle\Entity\RolloverAgreement;
use AppBundle\Entity\User;
use AppBundle\Form\ImproveLoyalityProgramRequestType;
use AppBundle\Form\ProfileAddressType;
use AppBundle\Form\ProfileBusinessType;
use AppBundle\Form\ProfileCardType;
use AppBundle\Form\ProfileDocumentsType;
use AppBundle\Form\ProfilePassportType;
use AppBundle\Form\ProfilePersonalType;
use AppBundle\Form\ProfileSocialType;
use AppBundle\Security\User\ApiUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfileController extends Controller
{
    protected function getRolloverAgreementTemplateForMail() {
        $api = $this->get('app.turnkey.lender.api');
        $loan = $api->getCustomerLoan(intval(18338));
        $user = $api->getCustomerDetails();
        $apiUser = $this->getUser();
        $user->setLogin($apiUser->getUsername());
        /** @var ApiUser $apiUser */

        if (empty($loan)) {
            return new JsonResponse([
                'url' => $this->generateUrl('app.loan.rollover.sign.error'),
            ]);
        }

        $parser          = $this->container->get( 'templating.name_parser' );
        $locator         = $this->container->get( 'templating.locator' );
        $templatePath    = $locator->locate( $parser->parse( 'pdf/rollover.agreement.mail.html.twig' ) );
        $templateContent = file_get_contents( $templatePath );

        $agreementDocumentId = $this
            ->getDoctrine()
            ->getRepository(RolloverAgreement::class)
            ->nextAgreementId($loan);

        $agreement = new RolloverAgreement($agreementDocumentId, $user, $loan, 30, 1, $templateContent);

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
        return $response;
    }

    public function profileAction(Session $session)
    {
        //return $this->getRolloverAgreementTemplateForMail(); //for test generate rollover doc sending on mail
        $user = $this->getUser();
        if (!$user || !($user instanceof ApiUser)) {
            return $this->redirectToRoute('app.login');
        }
        $api = $this->get('app.turnkey.lender.api');
        $customerBonuses = $api->getCustomerBonuses();
        $loyalityParameters = $api->getLoyalityParameters();
        $creditProduct = $api->getDefaultProduct();
        $loans = $api->getCustomerLoans();
        $activeLoans = $api->getCustomerActiveLoans($loans);
        $loansHistory = $api->getCustomerLoansHistory($loans);
        $loansHistoryRolloversDocs = $this->getDoctrine()
	        ->getRepository(RolloverAgreement::class)
	        ->getAgreementDocIdsForLoans($user, $loansHistory);
        $bonusExchangeRate = $api->getBonusExchangeRate();
        $loansHistoryTotalAmount = array_sum(array_map(function(Loan $loan) {
            return $loan->getAmount();
        }, $loansHistory));
        $bonusHistory = $api->getBonusHistory();

        $loyalityMapping = [
            'maxAmount' => $creditProduct['MaxAmountLine'],
            'maxTerm' => $creditProduct['MaxTermLine'],
            'interestRate' => $creditProduct['InterestRateLine'],
        ];

        $W4PConfig = $api->linkBankCard();
        $W4PConfig = isset($W4PConfig['Data']['Data']) ? $W4PConfig['Data']['Data'] : null;
        $W4PConfig['requestType'] = 'VERIFY';
        $W4PConfig['straightWidget'] = true;

        $activeTab = $session->getFlashBag()->get('profileTab');
        $activeTab = !empty($activeTab) ? reset($activeTab) : null;

        return $this->render('security/profile.html.twig', [
            'customerBonuses' => $customerBonuses,
            'loyalityParameters' => $loyalityParameters,
            'loyalityMapping' => $loyalityMapping,
            'activeLoans' => $activeLoans,
            'loansHistory' => $loansHistory,
            'loansHistoryRolloversDocs' => $loansHistoryRolloversDocs,
            'loansHistoryTotalAmount' => $loansHistoryTotalAmount,
            'bonusExchangeRate' => $bonusExchangeRate,
            'bonusHistory' => $bonusHistory,
            'W4PConfig' => $W4PConfig,
            'activeTab' => $activeTab,
            'limitAmount' => $session->has('limitAmount') ? $session->get('limitAmount') : false,
            'rejectedAmount' => $session->getFlashBag()->has('rejectedAmount') ? $session->getFlashBag()->get('rejectedAmount')[0] : false,
            'rejectedLoan' => $session->getFlashBag()->has('rejectedLoan') ? $session->getFlashBag()->get('rejectedLoan')[0] : false
        ]);
    }

    public function improveLoyalityProgramButtonAction($maxAmountDegree = 0, $maxTermDegree = 0, $interestRateDegree = 0)
    {
        if (!$this->getUser() || !($this->getUser() instanceof ApiUser)) {
            return new Response();
        }

        if (!$maxAmountDegree && !$maxTermDegree && !$interestRateDegree) {
            return new Response();
        }
        
        $formData = new ImproveLoyalityProgramRequest();

        try {
            $formData->setMaxAmountDegree(new BonusesDegree($maxAmountDegree));
            $formData->setMaxTermDegree(new BonusesDegree($maxTermDegree));
            $formData->setInterestRateDegree(new BonusesDegree($interestRateDegree));
        }
        catch (\Exception $e) {
            return new Response();
        }
        
        $form = $this->createForm(ImproveLoyalityProgramRequestType::class, $formData, [
            'action' => $this->generateUrl('app.improve.loyality.program.submit'),
        ]);
        
        return $this->render('components/form-improve-loyality-program.html.twig', [
            'form' => $form->createView(),
            'formData' => $formData,
        ]);
    }

    public function improveLoyalityProgramButtonSubmitAction(Request $request)
    {
        if (!$this->getUser() || !($this->getUser() instanceof ApiUser)) {
            return $this->redirectToRoute('app.login');
        }
        
        $referer = $request->headers->get('referer');

        if (!$referer) {
            return $this->createNotFoundException();
        }

        $formData = new ImproveLoyalityProgramRequest();
        
        $form = $this->createForm(ImproveLoyalityProgramRequestType::class, $formData);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $api = $this->get('app.turnkey.lender.api');
            $api->improveLoyalityProgram($formData);
        }
        
        return $this->redirect($referer . '#tab-bonuses');
    }
    
    public function editProfileAction($viewForm = null, Request $request)
    {
        $api = $this->get('app.turnkey.lender.api');

        $profile = $api->getCustomerDetails();
        
        $card = $api->getBankCardDetails();

        $hasUnpaidLoans = $api->customerHasUnpaidLoans();
        
        $form = [
            'personal' => $this->createForm(ProfilePersonalType::class, $profile, [
                'action' => $this->generateUrl('app.profile.edit'),
            ]),
            'social' => $this->createForm(ProfileSocialType::class, $profile, [
                'action' => $this->generateUrl('app.profile.edit'),
            ]),
            'passport' => $this->createForm(ProfilePassportType::class, $profile, [
                'action' => $this->generateUrl('app.profile.edit'),
            ]),
            'business' => $this->createForm(ProfileBusinessType::class, $profile, [
                'action' => $this->generateUrl('app.profile.edit'),
            ]),
            'address' => $this->createForm(ProfileAddressType::class, $profile, [
                'action' => $this->generateUrl('app.profile.edit'),
            ]),
            'card' => $this->createForm(ProfileCardType::class, $card, [
                'action' => $this->generateUrl('app.profile.edit'),
            ]),
            'documents' => $this->createForm(ProfileDocumentsType::class, $profile, [
                'action' => $this->generateUrl('app.profile.edit.section', [
                    'viewForm' => 'documents',
                ]),
            ]),
        ];

        foreach ($form as $key => $value) {
            $form[$key]->handleRequest($request);
            if ($form[$key]->isSubmitted()) {
                if ($form[$key]->isValid() && (!$hasUnpaidLoans || $key == 'documents')) {
                    $api->updateCustomerDetails($profile);
                    /** @var ApiUser $currentUser */
                    $currentUser = $this->getUser();
                    $this
	                    ->get('app.turnkey.lender.api.sync_helper')
	                    ->syncUserData($currentUser->getUsername())
                    ;
                    
                    return $this->redirectToRoute('app.profile.edit.section', [
                        'viewForm' => $key,
                        'profile' => $profile,
                        'card' => $card,
                    ]);
                }
            }
        }
        
        if (!empty($viewForm) && isset($form[$viewForm])) {
            return $this->render("profile/edit/{$viewForm}.html.twig", [
                'form'  =>  $form[$viewForm]->createView(),
                'hasUnpaidLoans' => $hasUnpaidLoans,
                'profile' => $profile,
                'card' => $card,
            ]);
        }
        
        return $this->render('profile/edit.html.twig', [
            'form'  =>  array_map(function(Form $form){
                            return $form->createView();
                        }, $form),
            'hasUnpaidLoans' => $hasUnpaidLoans,
            'profile' => $profile,
            'card' => $card,
        ]);
    }
    
    public function changePasswordAction(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Текущий пароль',
                'constraints' => array(
                    new NotBlank(),
                ),
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Пароли не совпадают.',
                'first_options'  => [
                    'label' => 'Новый пароль',
                    'constraints' => [
                        new NotBlank(),
                    ],
                ],
                'second_options' => [
                    'label' => 'Повторите новый пароль',
                ],
            ])
            ->setAction($this->generateUrl('app.profile.change_password.submit'))
            ->getForm();
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $currentPassword = $form->get('currentPassword')->getData();
            $newPassword = $form->get('newPassword')->getData();
            
            $api = $this->get('app.turnkey.lender.api');
            $translator = $this->get('translator');
            $locale = $translator->getLocale();
            $catalogue = $translator->getCatalogue($locale);
            
            $result = $api->changeCustomerPassword($currentPassword, $newPassword);
            
            if (!empty($result) && !empty($result['Success'])) {
                return new JsonResponse([
                    'messages' => [
                        [
                            'type' => 'success',
                            'text' => $translator->trans('Пароль изменен.'),
                        ],
                    ]
                ]);
            }

            $errorMessage = 
                (!empty($result['Message']) && $catalogue->defines($result['Message'], 'api_errors'))
                    ? $translator->trans(/** @Ignore */$result['Message'], [], 'api_errors') 
                    : $translator->trans('Во время изменения пароля произошла ошибка.');

            return new JsonResponse([
                'messages' => [
                    [
                        'type' => 'error',
                        'text' => $errorMessage,
                    ],
                ]
            ]);
        }
        
        return $this->render('profile/settings/form-change-password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    public function editDocumentsAction()
    {
        
    }
}