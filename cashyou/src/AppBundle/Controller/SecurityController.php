<?php
namespace AppBundle\Controller;

use AppBundle\Entity\ForgotPasswordForm;
use AppBundle\Entity\ResetPasswordForm;
use AppBundle\Form\ForgotPasswordType;
use AppBundle\Form\ResetPasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{
    public function loginAction()
    {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('app.home');
        }

        return $this->render('security/login.html.twig');
    }

    public function forgotPasswordAction(Request $request)
    {
        return $this->forgotPassword($request);
    }

    public function forgotPasswordFormAction(Request $request)
    {
        return $this->forgotPassword($request, 'security/form-forgot-password.html.twig');
    }
    
    public function resetPasswordAction(Request $request)
    {
        $userId = $request->query->get('userId');
        $code = $request->query->get('code');
        
        if (empty($userId) || empty($code)) {
            return $this->redirectToRoute('app.home');
        }

        $code = str_replace(' ', '+', $code);
        
        $resetPassword = new ResetPasswordForm();
        
        $form = $this->createForm(ResetPasswordType::class, $resetPassword);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $translator = $this->get('translator');
            $api = $this->get('app.turnkey.lender.api');
            
            $result = $api->resetPassword($userId, $code, $resetPassword->getPassword());
            
            if (!empty($result) && !empty($result['Success'])) {
                $this->addFlash('success', $translator->trans("Пароль изменен."));
                return $this->redirectToRoute('app.login');
            }
            
            
            $form->addError(new FormError($translator->trans("Произошла ошибка.")));
        }
        
        return $this->render('security/reset-password.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    protected function forgotPassword(Request $request, $template = 'security/forgot-password.html.twig')
    {
        $translator = $this->get('translator');
        $forgotPassword = new ForgotPasswordForm();
        $form = $this->createForm(ForgotPasswordType::class, $forgotPassword, [
            'action' => $this->generateUrl('app.password.reset'),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $response = $this->get('app.turnkey.lender.api')->forgotPassword($forgotPassword->getEmail());
            if (!empty($response)) {
                if (isset($response['Success'])) {
                    if ($response['Success']) {
                        $this->addFlash('success', $translator->trans("Письмо с инструкциями по восстановлению пароля было отправлено на вашу почту."));

                        return $this->redirectToRoute('app.password.reset');
                    } else {
                        $form->addError(new FormError($translator->trans("Пользователь с таким email не найден.")));
                    }
                } else {
                    $form->addError(new FormError($translator->trans("Произошла ошибка.")));
                }
            } else {
                $form->addError(new FormError($translator->trans("Произошла ошибка.")));
            }
        }

        return $this->render($template, [
            'form' => $form->createView(),
        ]);
    }
}