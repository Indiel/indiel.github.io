<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Gender;
use AppBundle\Entity\LoanApplication;
use AppBundle\Entity\TrackingStatus;
use AppBundle\Entity\User;
use AppBundle\Entity\YesNo;
use AppBundle\Form\LoanApplicationType;
use AppBundle\Form\RegistrationFormType;
use AppBundle\Security\Authentication\Token\TurnkeyLenderApiToken;
use AppBundle\Security\User\ApiUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class RegistrationController extends Controller
{
    public function registrationAction(Request $request, SessionInterface $session)
    {
        $user = new User();
        $user->setIsPassportNewType(new YesNo(YesNo::NO));
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        $translator = $this->get('translator');
        
        $api = $this->get('app.turnkey.lender.api');

        $W4PConfig = false;

        $loanApplication = $session->get('loanApplication');
        
        if (!$loanApplication) {
            return $this->redirectToRoute('app.home');
        }
        
        $trackingHelper = $this->get('app.tracking.helper');

        if ($form->isSubmitted() && $form->isValid()) {
            $loggedIn = $this->getUser() && ($this->getUser() instanceof ApiUser);
            if ($loggedIn || $this->registerAndLoginUser($user, $request)) {
                $W4PConfig = $api->linkBankCard();
                $W4PConfig = isset($W4PConfig['Data']['Data']) ? $W4PConfig['Data']['Data'] : null;
                $W4PConfig['requestType'] = 'VERIFY';
                $W4PConfig['straightWidget'] = true;

                if ($this->updateUserProfile($user)) {
                    //check if first step submitted
                    if (!$user->getPassport()) {
                        $trackingHelper->postBack(new TrackingStatus(TrackingStatus::LEAD), [
                            'extra_param_1' => $user->getEmail(),
                            'extra_param_2' => trim(str_replace('+', '', $user->getPhone())),
                            'extra_param_3' => $user->getLastName(),
                            'extra_param_4' => $user->getFirstName(),
                            'extra_param_5' => $user->getMiddleName(),
                            'extra_param_6' => ($user->getGender()->getValue() == Gender::FEMALE) ? 'Жіноча' : 'Чоловіча',
                            'extra_param_7' => $user->getBirthDate()->format('d.m.Y'),
                        ]);
                    }
                    
                    if ($request->isXmlHttpRequest()) {
                        return new JsonResponse([
                            'W4PConfig' => $W4PConfig,
                            'form' => $this->renderView( 'security/form-registration.html.twig', [
                                'form' => $form->createView(),
                                'W4PConfig' => $W4PConfig,
                                'phoneVerifyStorage' => $this->get('app.phone_verify_storage'),
                            ]),
                        ]);
                    }
                    
                    return $this->redirectToRoute('app.register');
                } else {
                    $form->addError(new FormError($translator->trans('Во время сохранения данных профиля произошла ошибка.')));
                }
            } else {
                $form->get('email')->get('first')->addError(new FormError($translator->trans('Пользователь с таким email уже зарегистрирован.')));
            }
        }
        
        if (!$W4PConfig) {
            $W4PConfig = $api->linkBankCard();
            $W4PConfig = isset($W4PConfig['Data']['Data']) ? $W4PConfig['Data']['Data'] : null;
            $W4PConfig['requestType'] = 'VERIFY';
        }        

        return $this->render($request->isXmlHttpRequest() ? 'security/form-registration.html.twig' : 'security/registration.html.twig', [
            'form' => $form->createView(),
            'W4PConfig' => $W4PConfig,
            'phoneVerifyStorage' => $this->get('app.phone_verify_storage'),
        ]);
    }

    public function uploadFileAction(Request $request) {
        $form = $this->get('form.factory')
            ->createNamedBuilder('',FormType::class,null, ['csrf_protection' => false])
            ->add('file', FileType::class)
            ->add('fieldName', TextType::class)
            ->getForm()
        ;

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var File $file
             */
            $file = $form['file']->getData();
            $fieldName = $form['fieldName']->getData();
            try{
                //throw new \Exception('Api response was not decoded');                 
                if (!$file->guessExtension()) {
                    return new JsonResponse([
                        'error' => 'type',
                    ]);
                }

                $result = $this->get('app.turnkey.lender.api')->uploadDocument($file);

                /* Присвоение загруженного файла текущему пользователю 
                 * с целью не потерять его при обновлении страницы до сабмита формы 
                 */
                $responce = new JsonResponse($result);

                $setFunctionName = 'set'.$fieldName;

                $entityManager = $this->getDoctrine()->getManager();

                $user = $entityManager->getRepository(User::class)->findOneBy(['login' => $this->getUser()->getUsername()]);

                $user->$setFunctionName('['.$responce->getContent().']');                        
                $entityManager->flush();

                if ($result) {
                    return $responce;
                } 
            } catch(\Exception  $e){

                $logger = $this->get('logger');

                $logger->error('FILE UPLOAD ERROR', [
                    'user' => $this->getUser()->getUsername(),
                    'file_info' => $_FILES,                    
                ]);

                return new JsonResponse([
                    'error' => 'fatal',
                ]);
            } 
            
        }

        return new JsonResponse([
            'error' => 'other',
        ]);
    }

    public function linkBankCardAction(Request $request, SessionInterface $session)
    {
        $form =
            $this->createFormBuilder(null, [
                'action' => $this->generateUrl('app.link.card'),
            ])
                ->add('loanId', HiddenType::class)
                ->getForm();

        $form->handleRequest($request);

        $loanId = null;

        if ($form->isSubmitted() and $form->isValid()) {
            //was for agreement preview step
            /*if ($form->get('loanId')->getData()) {
                $session->remove('loanApplication');

                return new Response();
            }*/

            if ($loanApplication = $session->get('loanApplication')) {
                $logger = $this->get('logger');
                try {
                    $api = $this->get('app.turnkey.lender.api');
                    $user = $api->getCustomerDetails();
                    $rtClient = $this->get('app.risktools.client');
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
                        $result = $api->applyForLoan($loanApplication);
                        if (empty($result) || empty($result['Success']) || empty($result['LoanId'])) {
                            return new HttpException(400);
                        }
                        $session->remove('loanApplication');

                        $response = new Response();
                        $this->removeCookiesAfterSendRequestTKL($request, $response);

                        return $response;
                    }
                    elseif($response['amount_limit'] == 0) {
                        $this->addFlash('rejectedLoan', true); //activate popup
                        $loanApplication->setAmount(101);
                        $result = $api->applyForLoan($loanApplication);
                        if (!empty($result) && !empty($result['Success'])) {
                            $response = new Response('profile');

                            $this->removeCookiesAfterSendRequestTKL($request, $response);
                            return $response;
                        }
                        return new HttpException(400);
                    }
                    elseif($response['amount_limit'] < $loanApplication->getAmount()) {
                        $session->set('limitAmount', $response['amount_limit']);
                        $session->set('loanApplication', $loanApplication);
                        $this->addFlash('rejectedAmount', $loanApplication->getAmount()); //activate popup
                        return new Response('profile');
                    }
                }
                catch (\Exception  $e) {
                    $logger->info('RISK TOOLS CALL', [
                        'method' => $method,
                        'response' => $e,
                        'parameters' => $applicationData,
                        'url' => $rtClient->url,
                        'key' => $rtClient->key
                    ]);
                    $result = $api->applyForLoan($loanApplication);
                    if (empty($result) || empty($result['Success']) || empty($result['LoanId'])) {
                        return new HttpException(400);
                    }
                    $session->remove('loanApplication');

                    $response = new Response();
                    $this->removeCookiesAfterSendRequestTKL($request, $response);

                    return $response;
                }
            }
        }

        return $this->render('security/form-link-bank-card.html.twig', [
            'form' => $form->createView(),
            'loanId' => $loanId,
        ]);
    }

    public function removeCookiesAfterSendRequestTKL($request, $response)
    {
        if($request->cookies->get('service') == 'keitaro') {
            $this->get('app.tracking.helper')->postBack(new TrackingStatus(TrackingStatus::SALE));
            $response->headers->removeCookie('subid');
            $response->headers->removeCookie('service');
        }
        if ($ctsid = $request->cookies->get('ctsid')) {
            $this->get('app.cashyou.tracker.helper')->track($ctsid, 'lead');
        }
    }

    public function profileInfoAction()
    {
        $profile = $this->get('app.turnkey.lender.api')->getCustomerDetails();

        $response = new JsonResponse($profile->apiExport());

        $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);

        return $response;
    }

    public function apiTokenAction()
    {
        $tokenStorage = $this->get('security.token_storage');
        $user = $tokenStorage->getToken()->getUser();
        if ($user instanceof ApiUser) {
            return new Response($user->getApiToken());
        }

        return new Response();
    }

    protected function registerAndLoginUser(User $user, Request $request)
    {
        $firewall_name = 'main';

        //try to register new user
        $api = $this->get('app.turnkey.lender.api');
        $cache = $this->get('app.security.user.provider.cache');

        $response = $api->registerCustomer($user->getEmail(), $user->getPassword());

        //if registration failed (user exists), try to login user
        if (empty($response) || empty($response['Success']) || empty($response['CustomerAuthToken'])) {
            return false;
        }

        $apiUser = new ApiUser($user->getEmail(), $response['CustomerAuthToken']);
        $cache->save( md5($apiUser->getUsername() . $this->getParameter('secret')),  $apiUser );

        $token = new TurnkeyLenderApiToken($apiUser, $user->getPassword(), $firewall_name, $response['CustomerAuthToken'], $apiUser->getRoles());
        $this->get('security.token_storage')->setToken($token);

        $event = new InteractiveLoginEvent($request, $token);
        $this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

        //save user to db
        $this
	        ->get('app.turnkey.lender.api.sync_helper')
	        ->syncUserData($apiUser->getUsername())
        ;

        return true;
    }

    protected function updateUserProfile(User $user)
    {
        $result = $this->get('app.turnkey.lender.api')->updateCustomerDetails($user);

        if (empty($result) || empty($result['Success'])) {
            return false;
        }

	    //save user to db
	    /** @var ApiUser $currentUser */
	    $currentUser = $this->getUser();
	    $this
		    ->get('app.turnkey.lender.api.sync_helper')
		    ->syncUserData($currentUser->getUsername())
	    ;

        return true;
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