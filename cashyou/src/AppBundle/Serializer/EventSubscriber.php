<?php

namespace AppBundle\Serializer;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;

class EventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => 'serializer.pre_deserialize',
                'method' => 'onPreDeserialize',
            ],
        ];
    }
    
    public function onPreDeserialize(PreDeserializeEvent $event)
    {
        $type = $event->getType();
        
        if ($type['name'] == 'DateTime' 
            && !empty($type['params']) 
            && $type['params'][0] == 'Y-m-d\TH:i:s.uT') {
                
            $data = $event->getData();
            
            if (!empty($data) && !preg_match('|\.[0-9]{1,3}Z$|', $data)) {
                $event->setType($type['name'], []);
            }
        }
    }
}