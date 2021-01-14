<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use Progrupa\Sketchup3DWarehouseBundle\Exception\InvalidArgumentException;

class SubjectClass
{
    const BINARY = 'binary';
    const COLLECTION = 'collection';
    const ENTITY = 'entity';
    const USER = 'user';

    const PLURAL_BINARY = 'binaries';
    const PLURAL_COLLECTION = 'collections';
    const PLURAL_ENTITY = 'entities';
    const PLURAL_USER = 'users';

    public static function fromResource(WarehouseResource $resource)
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

    public static function pluralFromResource(WarehouseResource $resource)
    {
        if ($resource instanceof Binary) {
            return SubjectClass::PLURAL_BINARY;
        } elseif ($resource instanceof Collection) {
            return SubjectClass::PLURAL_COLLECTION;
        } elseif ($resource instanceof Entity) {
            return SubjectClass::PLURAL_ENTITY;
        } elseif ($resource instanceof User) {
            return SubjectClass::PLURAL_USER;
        } else {
            throw new InvalidArgumentException(sprintf('Cannot create SubjectClass from %s', get_class($resource)));
        }
    }
}
