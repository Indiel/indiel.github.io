<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class TrackingListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if ($event->isMasterRequest()) {
            if ($subid = $event->getRequest()->get('subid')) {
                $response = $event->getResponse();
                $response->headers->setCookie(new Cookie('subid', $subid, new \DateTime('+1 month')));
                $response->headers->setCookie(new Cookie('service', 'keitaro', new \DateTime('+1 month')));
            }
        }
    }
}