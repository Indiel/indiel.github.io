<?php

namespace AppBundle\EventSubscriber;

use JMS\I18nRoutingBundle\Router\LocaleResolverInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class LocaleSubscriber implements EventSubscriberInterface
{
    /**
     * @var LocaleResolverInterface
     */
    protected $localeResolver;
    
    public function __construct(LocaleResolverInterface $localeResolver)
    {
        $this->localeResolver = $localeResolver;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $request->setLocale('uk');
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::REQUEST => array(array('onKernelRequest', 15)),
        );
    }
}