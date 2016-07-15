<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use Progrupa\Sketchup3DWarehouseBundle\Exception\InvalidArgumentException;

class SubjectClass
{
    const BINARY = 'binary';
    const COLLECTION = 'collection';
    const ENTITY = 'entity';
    const USER = 'user';

    public static function fromResource(Resource $resource)
    {
        if ($resource instanceof Binary) {
            return SubjectClass::BINARY;
        } elseif ($resource instanceof Collection) {
            return SubjectClass::COLLECTION;
        } elseif ($resource instanceof Entity) {
            return SubjectClass::ENTITY;
        } elseif ($resource instanceof User) {
            return SubjectClass::USER;
        } else {
            throw new InvalidArgumentException(sprintf('Cannot create SubjectClass from %s', get_class($resource)));
        }
    }
}
