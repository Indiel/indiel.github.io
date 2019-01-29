<?php
namespace AppBundle\Security\Authentication\Handler;

use AppBundle\Helper\ApiSyncHelper;
use AppBundle\Helper\TurnkeyLenderApi;
use AppBundle\Security\User\ApiUser;
use AppBundle\Entity\User;
use AppBundle\Entity\RegistrationStep;
use AppBundle\Helper\AlertHelper;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Http\Logout\LogoutSuccessHandlerInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AuthenticationHandler implements LogoutSuccessHandlerInterface, AuthenticationSuccessHandlerInterface
{
    private $router;
    private $api;
    private $apiSyncHelper;

    public function __construct(Router $router, 
        TurnkeyLenderApi $api, 
        ApiSyncHelper $apiSyncHelper, 
        ContainerInterface $container,
        AlertHelper $alertHelper,
        TranslatorInterface $translator)
    {
        $this->router        = $router;
        $this->api           = $api;
        $this->apiSyncHelper = $apiSyncHelper;
        $this->container     = $container;
        $this->alertHelper   = $alertHelper;
        $this->translator    = $translator;
    }

    /**
     * @inheritdoc
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
    {
        $user = $token->getUser();
        if ($user && ($user instanceof ApiUser)) {
            $this->apiSyncHelper->syncUserData($user->getUsername());
        }

        // check if user not continue registration        
        $doctrine = $this->container->get('doctrine');
        $repository = $doctrine->getRepository(User::class);
        $dbUser = $repository->findOneBy(['login' => $user->getUsername()]);
        if(!empty($dbUser)){
            $currentStepId = $dbUser->getCurrentStep();

            if($currentStepId){ 
                $repository = $doctrine->getRepository(RegistrationStep::class);
                $currentStepObj = $repository->findOneBy(['id' => $currentStepId]);
                $currentStepAlias = $currentStepObj->getAlias();                
                if($currentStepAlias!='finish'){
                    // Если до логина уже была нотификация о том,
                    // что у нас требуется продолжение регистрации
                    // повторно мы уведомление не выводим
                    /*$continueByNotification = $session->get('continueByNotification');
                    if($continueByNotification){
                        $session->remove('loanApplication');
                    } else {*/

                        $this
                            ->alertHelper
                            ->addAlert(
                                $this->translator->trans('Вы не окончили регистрацию в нашей системе. Для того чтобы продолжить работу Вам необходимо пройти регистрацию с того шага, на котором вы остановились')
                            )
                        ;
                    //}
                    
    /*echo $this->router->generate('app.registration-new', array(
                        'step' => $currentStepAlias
                    )); die;*/

                    return new RedirectResponse($this->router->generate('app.registration-new', array(
                        'step' => $currentStepAlias
                    )), 302);
                } else {
                    return new RedirectResponse($this->router->generate('app.profile'), 302);
                }
            } else {
                return new RedirectResponse($this->router->generate('app.profile'), 302);
            }
        } else {
            return new RedirectResponse($this->router->generate('app.profile'), 302);
        }
                
    }

    /**
     * @inheritdoc
     */
    public function onLogoutSuccess(Request $request)
    {
        return new RedirectResponse($this->router->generate('app.home'), 302);
    }
}