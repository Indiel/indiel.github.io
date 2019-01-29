<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CheckPhoneController extends Controller
{
    public function sendCodeAction(Request $request)
    {
        $phone = $request->request->get('phone');
        $phone = $phone ? preg_replace('|[^\+0-9]|', '', $phone) : $phone;
        
        if (!$phone) {
            return new JsonResponse([
                'success' => false,
                'error' => $this->get('translator')->trans('Не указан номер телефона'),
            ]);
        }

        $verifyStorage = $this->get('app.phone_verify_storage');
        
        if ($verifyStorage->isVerified($phone)) {
            return new JsonResponse([
                'success' => false,
                'already' => true,
                'error' => $this->get('translator')->trans('Данный номер уже подтвержден'),
            ]);
        }
        
        $code = mt_rand (1000, 9999);
        $message = $this->get('translator')->trans('Vash kod perevirky mobilnogo telefonu: %code%. Cashyou.ua kredyt online. Tel:08002122300', [
            '%code%' => $code,
        ]);
        
        $this->get('app.turbosms')->send($message, $phone);

        $verifyStorage->setVerificationCode($phone, $code);
        
        return new JsonResponse([
            'success' => true,
        ]);
    }
    
    public function checkCodeAction(Request $request)
    {
        $code = $request->request->get('code');
        $verifyStorage = $this->get('app.phone_verify_storage');
        
        $verified = $verifyStorage->verifyCode($code);

        if ($verified) {
            return new JsonResponse([
                'success' => true,
            ]);
        }
        
        return new JsonResponse([
            'success' => false,
            'error' => $this->get('translator')->trans('Код не верный'),
        ]);
    }
}