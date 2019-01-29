<?php

namespace AppBundle\Helper;

use Symfony\Component\HttpFoundation\Session\Session;

class AlertHelper
{
    protected $session;
    
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    
    public function addAlert($message)
    {
        $this->session->getFlashBag()->set('alertMessage', $message);
    }
    
    public function getAlert() {
        $alert = $this->session->getFlashBag()->get('alertMessage');
        
        return !empty($alert) ? reset($alert) : null;
    }
}