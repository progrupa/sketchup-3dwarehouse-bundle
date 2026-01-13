<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Progrupa\Sketchup3DWarehouseBundle\Exception\InvalidArgumentException;

 * Class SubjectResource
 * @package Progrupa\Sketchup3DWarehouseBundle\Model
abstract class SubjectResource implements WarehouseResource
{
    /**
     * @var string
     */
    protected $subjectId;
    /**
     * @var string
     */
    protected $subjectClass;

    public function __construct($subjectId, $subjectClass)
    {
        $this->subjectId = $subjectId;
        $this->subjectClass = $subjectClass;
    }

    /**
     * @param Resource $obj
     * @return $this
     */
    public static function fromObject(WarehouseResource $obj)
    {
        $class = get_called_class();

        return new $class($obj->getId(), SubjectClass::pluralFromResource($obj));
    }

    /** @return array */
    public function extraAttributes($groups = [])
    {
        return [];
    }

    /** @return string */
    public function getId()
    {
        return null;
    }

    /**
     * @return string
     */
    public function getSubjectId()
    {
        return $this->subjectId;
    }

    /**
     * @param string $subjectId
     */
    public function setSubjectId($subjectId)
    {
        $this->subjectId = $subjectId;
    }

    /**
     * @return string
     */
    public function getSubjectClass()
    {
        return $this->subjectClass;
    }

    /**
     * @param string $subjectClass
     */
    public function setSubjectClass($subjectClass)
    {
        $this->subjectClass = $subjectClass;
    }

    /** @return string */
    public function getResource()
    {
        return sprintf("%s/%s/%s",
            $this->getSubjectClass(),
            $this->getSubjectId(),
            static::RESOURCE
        );
    }
}
