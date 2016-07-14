<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


class Binary extends GenericResource
{
    const GET = 'getbinary';
    const UPDATE = 'setbinary';
    const DELETE = 'deletebinary';

    /** @return array */
    public function attributes()
    {
        return [];
    }
}
