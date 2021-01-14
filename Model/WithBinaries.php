<?php


namespace Progrupa\Sketchup3DWarehouseBundle\Model;


trait WithBinaries
{
    /**
     * @return string
     */
    public function binariesResource($name = null)
    {
        if (is_null($name)) {
            return sprintf("%s/%s/binaries",
                $this->getResource(),
                $this->getId()
            );
        } else {
            return sprintf("%s/%s/binaries/%s",
                $this->getResource(),
                $this->getId(),
                $name
            );
        }
    }
}