<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AlertController extends Controller
{
    public function showAction()
    {
        $message = $this->get('app.alert.helper')->getAlert();
        
        if (empty($message)) {
            return new Response();
        }
        
        return $this->render('components/alert-popup.html.twig', [
            'message' => $message,
        ]);
    }
}
