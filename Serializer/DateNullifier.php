<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Serializer;


use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\PreDeserializeEvent;

class DateNullifier implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return array(
            array('event' => 'serializer.pre_deserialize', 'method' => 'onPreDeserialize'),
        );
    }

    public function onPreDeserialize(PreDeserializeEvent $event)
    {
        $type = $event->getType();
        if ($type['name'] === 'DateTime' && $event->getData() === '') {
            $event->setData(null);
        }
    }
}
