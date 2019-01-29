<?php

namespace AppBundle\EventListener;

use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class TrackingSalesdoublerListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if ($event->isMasterRequest()) {
            if ($event->getRequest()->get('aff_sub') && $event->getRequest()->get('aff_id')) {
                $subid = $event->getRequest()->get('aff_sub');
                $response = $event->getResponse();
                $response->headers->setCookie(new Cookie('subid', $subid, new \DateTime('+65 days')));
                $response->headers->setCookie(new Cookie('service', 'salesdoubler', new \DateTime('+65 days')));
            }
        }
    }
}