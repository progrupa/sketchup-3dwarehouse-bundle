<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


class Collection extends GenericResource
{
    const GET = 'getcollection';
    const UPDATE = 'setcollection';
    const DELETE = 'deletecollection';

    /** @return array */
    public function attributes()
    {
        return [];
    }
}
