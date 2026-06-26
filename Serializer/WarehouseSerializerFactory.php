<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Builds the serializer the 3D Warehouse Client uses.
 *
 * It is deliberately decoupled from the host application's shared serializer,
 * which (since Symfony 6.4) enforces serialization groups via a class-metadata
 * factory and applies a snake_case name converter. The 3D Warehouse Java API
 * requires camelCase keys and the bundle's models express their read/write
 * contract through #[Groups]/#[SerializedName] attributes, so this serializer:
 *
 *  - reads PHP 8 attribute metadata (groups + serialized names) via AttributeLoader,
 *  - uses NO name converter, preserving camelCase property names, and
 *  - leaves nested object/date fields untouched unless explicitly grouped.
 */
final class WarehouseSerializerFactory
{
    public static function create(): Serializer
    {
        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());

        $objectNormalizer = new ObjectNormalizer(
            $classMetadataFactory,
            null, // no name converter -> keep camelCase attribute names
        );

        return new Serializer(
            [
                new BooleanNormalizer(),
                new DateTimeNormalizer(),
                $objectNormalizer,
                new ArrayDenormalizer(),
            ],
            [new JsonEncoder()],
        );
    }
}
