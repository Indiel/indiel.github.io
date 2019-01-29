<?php
/**
 * Created by PhpStorm.
 * User: r00d1k
 * Date: 8/16/18
 * Time: 12:55 AM
 */

namespace AppBundle\EventListener;


use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class SaveCashyouTrackerSessionIdListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if ($event->isMasterRequest()) {
            if ($sid = $event->getRequest()->get('sid')) {
                $event->getResponse()->headers->setCookie(
                    new Cookie('ctsid', $sid, new \DateTime('+30 days'))
                );
            }
        }
    }
}