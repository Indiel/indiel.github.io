<?php

namespace AppBundle\Controller;

use AppBundle\Entity\RegistrationStep;
use AppBundle\Entity\Gender;
use AppBundle\Entity\LoanApplication;
use AppBundle\Entity\TrackingStatus;
use AppBundle\Entity\User;
use AppBundle\Entity\YesNo;
use AppBundle\Form\LoanApplicationType;
use AppBundle\Form\RegistrationCreateAnAccountFormType;
use AppBundle\Security\Authentication\Token\TurnkeyLenderApiToken;
use AppBundle\Security\User\ApiUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RegistrationNewController extends Controller
{
    public function indexAction($step, Request $request, SessionInterface $session)
    {        
        // 1. нахождение шага в БД по алиасу
        // 1.1 проверка на валидность
        // 1.2 формирование имени искомой формы, вью
        // 1.3 получение следующего шага
        $repository = $this->getDoctrine()->getRepository(RegistrationStep::class);        
        $stepObj = $repository->findOneBy(['alias' => $step]);
        if(!$stepObj){            
            throw $this->createNotFoundException('No valid step for registration');
        }

        $stepArr = explode("-", $step);               
        $stepArrLow = array_map("ucfirst", $stepArr);        
        $stepLow = implode('', $stepArrLow);        

        $stepNextObj = $repository->findOneBy(['prevId' => $stepObj->getId()]);

        $prevURL = null;

        if($stepObj->getPrevId()){
            $stepPrevObj = $repository->findOneBy(['id' => $stepObj->getPrevId()]);
            $prevURL = $this->generateUrl('app.registration-new', array('step' => $stepPrevObj->getAlias()));            
        }

        // 2. инициализация сервисов
        $translator = $this->get('translator');
        
        $api = $this->get('app.turnkey.lender.api');

        $trackingHelper = $this->get('app.tracking.helper');        

        // 3. проверка лоан в сессии
        $loanApplication = $session->get('loanApplication');        
        /*if (!$loanApplication) {
            return $this->redirectToRoute('app.home');
        }   */         

        // 4. Проверка наличия пользователя в системе
        $existAndLoggedIn = $this->getUser() && ($this->getUser() instanceof ApiUser);
        
        // 5. Назначение сущности форме
        if($step == 'create-an-account'){ 
            if(!$existAndLoggedIn) {
                $user = new User();
                $user->setIsPassportNewType(new YesNo(YesNo::NO));
            } else {
                $repository = $this->getDoctrine()->getRepository(User::class);        
                $user = $repository->findOneBy(['login' => $this->getUser()->getUsername()]);
            }                      
        } else {
            if($existAndLoggedIn) {            
                $repository = $this->getDoctrine()->getRepository(User::class);        
                $user = $repository->findOneBy(['login' => $this->getUser()->getUsername()]);
            } else {
                return $this->redirectToRoute('app.home');
            }
        }                

        $entityManager = $this->getDoctrine()->getManager(); 

        // 6. отредиректить пользователя если шаг больше, чем текущий
        //if ($request->isMethod('get')) {
            if($existAndLoggedIn) {
                $currentStepId = $user->getCurrentStep();                         
                $repository = $this->getDoctrine()->getRepository(RegistrationStep::class);
                $currentStepObj = $repository->findOneBy(['id' => $currentStepId]);
                if($currentStepObj->getAlias() != 'finish') {                
                    if($stepObj->getNumber() > $currentStepObj->getNumber()){
                        return $this->redirectToRoute('app.registration-new', array(
                            'step' => $currentStepObj->getAlias()
                        ));
                    }
                }                                                  
            }

            if(!isset($currentStepObj)){
                $currentStepObj = $stepObj;
            }

            $steps = $entityManager->getRepository(RegistrationStep::class)->findAll();

            $totalBonus = 0;
            foreach ($steps as $stepItem) {            
                if($stepItem->getNumber() < $currentStepObj->getNumber()){
                    $totalBonus+=$stepItem->getBonus();
                }             
            }

            if($loanApplication){
                $haveLoan = 1;

                $productStr = $loanApplication->getProduct();        
          
                if($productStr == 'Initial credit product in 1.8%'){
                    $percentFl = 1.5;
                    $percent = '1,5';
                } else if($productStr == 'Initial credit product in 0.01%'){
                    $percentFl = 0.1;
                    $percent = '0,1';
                }

                $term = $loanApplication->getTerm();
                $amount = $loanApplication->getAmount();
                $addSum = round($amount*$percentFl/100*$term);                
                $returnAmount = $amount + $addSum;                            

                $bоnusSum = round($totalBonus/100);
                $returnAmountBonus = $returnAmount - $bоnusSum;
                
                $dayWord = '';

                if($term > 11 && $term < 19){
                    $dayWord = 'дней';
                } else {
                    $termRest = $term%10;
                    if($termRest == 1){
                        $dayWord = 'день';
                    } else if(in_array($termRest, [2, 3, 4])){
                        $dayWord = 'дня';
                    } else {
                        $dayWord = 'дней';
                    }
                }

                $dayWord = $translator->trans($dayWord);

                $headerData = [
                    'percent' => $percent,
                    'amount' => $amount,
                    'returnAmount' => $returnAmount,
                    'totalBonus' => $totalBonus,
                    'returnAmountBonus' => $returnAmountBonus,
                    'term' => $term,
                    'dayWord' => $dayWord
                ];        
            } else {
                $haveLoan = 0;
                $headerData = [
                    'totalBonus' => $totalBonus,
                ];
            }         
        //}                            

        $W4PConfig = false;

        if($step == 'link-card'){
            $W4PConfig = $api->linkBankCard();
            $W4PConfig = isset($W4PConfig['Data']['Data']) ? $W4PConfig['Data']['Data'] : null;
            //$W4PConfig['requestType'] = 'VERIFY';
            //$W4PConfig['requestType'] = 'Purchase';
            $W4PConfig['merchantTransactionType'] = 'AUTH';
            $W4PConfig['orderDate'] = date('U');
            $W4PConfig['productCount'] = 1;
            $W4PConfig['productPrice'] = 1;
            $W4PConfig['amount'] = 1;
            $W4PConfig['productName'] = 'Cashyou link bank card';
            $W4PConfig['straightWidget'] = true;
            $W4PConfig['merchantAccount'] = 'cashyou_com_ua_credit';  
            $W4PConfig['holdTimeout'] = 60;
                      
            //
            
            //$W4PConfig['merchantAuthType'] = 'SimpleSignature';

            /*$W4PConfig['clientFirstName'] = 'Вася';
            $W4PConfig['clientLastName'] = 'Пупкин';
            $W4PConfig['clientAddress'] = 'пр. Гагарина, 12';
            $W4PConfig['clientCity'] = 'Днепропетровск';
            $W4PConfig['clientEmail'] = 'some@mail.com';
            $W4PConfig['defaultPaymentSystem'] = 'card';*/

/*merchantAccount, merchantDomainName, orderReference, orderDate, amount, currency, productName[0],

productName[1]..., productName[n], productCount[0], productCount[1],..., productCount[n], productPrice[0], productPrice[1],..., productPrice[n]  разделенных “;”*/

            $string = $W4PConfig['merchantAccount'].";"
                        .$W4PConfig['merchantDomainName'].";"
                        .$W4PConfig['orderReference'].";"
                        .$W4PConfig['orderDate'].";"
                        ."1;"
                        .$W4PConfig['currency'].";"
                        .$W4PConfig['productName'].";"
                        .$W4PConfig['productCount'].";"
                        .$W4PConfig['productPrice'];
//echo $string; die;
/*
cashyou_com_ua_credit;www.cashyou.com;bd4f5b9d-aa37-44cb-8dc4-959075a66d42;1543481502;1;UAH;Cashyou link bank card;1;1;*/
/*
cashyou_com_ua_credit;www.cashyou.com;fdb18042-119d-4460-a2ef-b1ef349f4ba0;1543479996;1;UAH;Cashyou link bank card;1;1  */          
            /*www.market.ua;DH783023;1415379863;1547.36;UAH;Процессор Intel Core i5-4670 3.4GHz;Память Kingston DDR3-1600 4096MB PC3-12800;1;1;1000;547.36";*/
            $key = "fda868e2523a4103727b536e58b974e074e7d41d";
            $hash = hash_hmac("md5",$string,$key);
            $W4PConfig['merchantSignature'] = $hash;
        } else {            
            $form = $this->createForm('AppBundle\Form\Registration'.$stepLow.'FormType', $user);    
            $form->handleRequest($request);                             
        }

        if ($request->isMethod('post')) {

            if ($form->isSubmitted() && $form->isValid()) {                 
                $hasErrors = false;            
                if($step == 'create-an-account'){
                    if(!$existAndLoggedIn) {
                        $registerSuccess = $this->registerAndLoginUser($user, $request);
                        if(!$registerSuccess){
                            
                            if(!$this->loginUser($user, $request)){
                                // выдать ошибку на форму
                                $form->get('email')->get('first')->addError(new FormError($translator->trans('Пользователь с таким email уже зарегистрирован.')));                            

                                $hasErrors = true;
                            } else {                            
                        
                                $userExisted = $entityManager->getRepository(User::class)->findOneBy(['login' => $this->getUser()->getUsername()]);                                            
                                $currentStepId = $userExisted->getCurrentStep();                

                                $currentStepObj = $repository->findOneBy(['id' => $currentStepId]);

                                if($currentStepObj){
                                    if($currentStepObj->getAlias() == 'finish') {
                                    
                                        $this->addFlash('profileTab', 'info');

                                        $this
                                            ->get('app.alert.helper')
                                            ->addAlert(
                                                $this->get('translator')->trans('Вы уже зарегистрированы в системе.')
                                            )
                                        ;

                                        return $this->redirectToRoute('app.profile');
                                    } else {

                                        $this
                                            ->get('app.alert.helper')
                                            ->addAlert(
                                                $this->get('translator')->trans('Вы прервали регистрацию на этом шаге.')
                                            )
                                        ;

                                        return $this->redirectToRoute('app.registration-new', array(
                                                'step' => $currentStepObj->getAlias()
                                            ));
                                    } 
                                } else {
                                    $this->addFlash('profileTab', 'info');

                                    $this
                                        ->get('app.alert.helper')
                                        ->addAlert(
                                            $this->get('translator')->trans('Вы уже раннее окончили регистрацию в нашей системе. Проверьте актуальность данных')
                                        )
                                    ;

                                    return $this->redirectToRoute('app.profile');
                                }
                                
                               
                            }                                                                                                                                           
                            // 3) более правильным, если пользователь есть в системе 
                            // и он залогинен, то оформить на него кредит с параметрами
                            // с главной страницы

                        } else {
                            $existAndLoggedIn = true;
                        }
                    } 
                }            

                if($existAndLoggedIn){   
                    if($user->getDocPassport1Json() == '[{"error":"fatal"}]'){
                        $user->setDocPassport1Json('[]');
                    }

                    if($user->getDocPassport2Json() == '[{"error":"fatal"}]'){
                        $user->setDocPassport2Json('[]');
                    }

                    if($user->getDocPassport3Json() == '[{"error":"fatal"}]'){
                        $user->setDocPassport3Json('[]');
                    }

                    if($user->getDocIpnJson() == '[{"error":"fatal"}]'){
                        $user->setDocIpnJson('[]');
                    }
                    
                    if($user->getDocsJson() == '[{"error":"fatal"}]'){
                        $user->setDocsJson('[]');
                    }
                    
                    if ($this->updateUserProfile($user)) {
                        //check if first step submitted
                        if ($step == 'create-an-account') {
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
                        
                        $userAfrerUpdate = $entityManager->getRepository(User::class)->findOneBy(['login' => $this->getUser()->getUsername()]);                                    
                        $currentStepObj = $entityManager->getRepository(RegistrationStep::class)->findOneBy(['id' => $userAfrerUpdate->getCurrentStep()]);
                        if(!$currentStepObj || $stepNextObj->getNumber() > $currentStepObj->getNumber()) {

                            $userAfrerUpdate->setCurrentStep($stepNextObj->getId());                
                            $entityManager->flush(); 

                        }                                                       

                        return $this->redirectToRoute('app.registration-new', array(
                            'step' => $stepNextObj->getAlias()
                        ));
                    } else {
                        $form->addError(new FormError($translator->trans('Во время сохранения данных профиля произошла ошибка.')));
                    }
                }            
            }
        }                

        return $this->render($request->isXmlHttpRequest() ? 'security/form-registration.html.twig' : 'registration-new/index.html.twig', [
            'formView' => 'registration-new/'.$step.'-registration-form.html.twig',
            'form' => $form?$form->createView():null,
            'steps' => $steps,
            'currentStep' => $stepObj,
            'userCurrentStep' => $currentStepObj,
            'prevURL' => $prevURL,
            'W4PConfig' => $W4PConfig,
            'headerData' => $headerData,
            'phoneVerifyStorage' => $this->get('app.phone_verify_storage'),
            'haveLoan' => $haveLoan
        ]);
    }

    private function getErrorsFromForm(FormInterface $form)

    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
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

    protected function loginUser(User $user, Request $request)
    {
        $firewall_name = 'main';

        //try to register new user
        $api = $this->get('app.turnkey.lender.api');
        $cache = $this->get('app.security.user.provider.cache');

        $response = $api->loginCustomer($user->getEmail(), $user->getPassword());

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

    public function linkBankCardAction(Request $request, SessionInterface $session)
    {        
        $form =
            $this->createFormBuilder(null, [
                'action' => $this->generateUrl('app.link.card.new'),
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

            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneBy(['login' => $this->getUser()->getUsername()]);                                    

            $stepObj = $entityManager->getRepository(RegistrationStep::class)->findOneBy(['alias' => 'finish']);

            $user->setCurrentStep($stepObj->getId());                        

            $entityManager->flush();

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

                    $logger = $this->get('logger');

                    $logger->info('RT REQUEST', [
                        'user' => $this->getUser()->getUsername(),
                        'application_data' => $applicationData,                    
                    ]);

                    $method = '/scoring/get_score';
                    $response = $rtClient->exec($method, [
                        'application' => $applicationData
                    ], false);                    

                    $logger->info('RT RESPONCE', [
                        'user' => $this->getUser()->getUsername(),
                        'responce_data' => $response,                    
                    ]);

                    if($response['amount_limit'] >= $loanApplication->getAmount()) {                        
                        $result = $api->applyForLoan($loanApplication);
                        if (empty($result) || empty($result['Success']) || empty($result['LoanId'])) {
                            return new HttpException(400);
                        }
                        $session->remove('loanApplication');
                        
                        $response = new RedirectResponse($this->generateUrl('app.pending.approval'), 302);
                        $this->removeCookiesAfterSendRequestTKL($request, $response);

                        return $response;
                    }
                    elseif($response['amount_limit'] == 0) {
                        $this->addFlash('rejectedLoan', true); //activate popup
                        $loanApplication->setAmount(101);
                        $loanApplication->setProduct('reject');
                        $result = $api->applyForLoan($loanApplication);
                        if (!empty($result) && !empty($result['Success'])) {
                            $response = new RedirectResponse($this->generateUrl('app.profile'), 302);

                            $this->removeCookiesAfterSendRequestTKL($request, $response);
                            return $response;
                        }
                        return new HttpException(400);
                    }
                    elseif($response['amount_limit'] < $loanApplication->getAmount()) {
                        // новая страница с предложением пониженной суммы

                        $rejectedAmount = $loanApplication->getAmount();

                        if($loanApplication->getAmount() > 2000 && $response['amount_limit'] <= 2000){
                            $loanApplication->setProduct('Initial credit product in 0.01%');
                        }                        

                        $session->set('limitAmount', $response['amount_limit']);
                        $session->set('loanApplication', $loanApplication);
                        
                        $productStr = $loanApplication->getProduct();        
      
                        if($productStr == 'Initial credit product in 1.8%'){
                            $percentFl = 1.5;                            
                        } else if($productStr == 'Initial credit product in 0.01%'){
                            $percentFl = 0.1;                            
                        }

                        $term = $loanApplication->getTerm();
                        $returnSum = $response['amount_limit'] + round($response['amount_limit']*$percentFl/100*$term) - 20;

                        return $this->render('registration-new/less-sum-credit-dialog.html.twig', [
                            'limitAmount' => $response['amount_limit'],
                            'returnAmount' => $returnSum,
                            'rejectedAmount' => $rejectedAmount
                        ]);                        
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

                    $response = new RedirectResponse($this->generateUrl('app.profile'), 302);
                    $this->removeCookiesAfterSendRequestTKL($request, $response);

                    return $response;
                }
            } else {
                $response = new RedirectResponse($this->generateUrl('app.profile'), 302);
                return $response;
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