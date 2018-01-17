<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Serializer;


use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;

class Su3DWBooleanHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        $methods = array();
        $deserializationTypes = array('Su3DWBoolean');
        $serialisationTypes = array('Su3DWBoolean');

        foreach (array('json', 'xml', 'yml', 'array') as $format) {

            foreach ($deserializationTypes as $type) {
                $methods[] = [
                    'type' => $type,
                    'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                    'format' => $format,
                    'method' => 'deserializeSu3DWBooleanHandler',
                ];
            }

            foreach ($serialisationTypes as $type) {
                $methods[] = array(
                    'type' => $type,
                    'format' => $format,
                    'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                    'method' => 'serializeSu3DWBooleanHandler',
                );
            }
        }

        return $methods;
    }

    public function serializeSu3DWBooleanHandler($visitor, $data, array $type)
    {
        if (null === $data) {
            return null;
        }

        return $data ? 'true' : 'false';
    }

    public function deserializeSu3DWBooleanHandler($visitor, $data, array $type)
    {
        if (null === $data) {
            return null;
        }

        return strtolower($data) == 'true' ? true : false;
    }
}
