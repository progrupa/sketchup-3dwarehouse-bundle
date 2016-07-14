<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation\Type;
use Progrupa\Sketchup3DWarehouseBundle\Exception\InvalidArgumentException;

abstract class SubjectResource implements Resource
{
    /**
     * @var string
     * @Type("string")
     */
    protected $subjectId;
    /**
     * @var string
     * @Type("string")
     */
    protected $subjectClass;

    public function __construct($subjectId, $subjectClass)
    {
        $this->subjectId = $subjectId;
        $this->subjectClass = $subjectClass;
    }

    public static function fromObject($obj)
    {
        $class = get_called_class();

        if ($obj instanceof Collection) {
            return new $class($obj->getId(), SubjectClass::COLLECTION);
        } elseif ($obj instanceof Entity) {
            return new $class($obj->getId(), SubjectClass::ENTITY);
        } elseif ($obj instanceof User) {
            return new $class($obj->getId(), SubjectClass::USER);
        } else {
            throw new InvalidArgumentException(sprintf('Cannot create SubjectResource from %s', get_class($obj)));
        }
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
        return static::GET .sprintf('?subjectId=%s&subjectClass=%s', $this->getSubjectId(), $this->getSubjectClass());
    }

    /** @return string */
    public function updateResource()
    {
        return static::UPDATE .sprintf('?subjectId=%s&subjectClass=%s', $this->getId(), $this->getSubjectClass());
    }

    /** @return string */
    public function deleteResource()
    {
        return static::DELETE .sprintf('?subjectId=%s&subjectClass=%s', $this->getId(), $this->getSubjectClass());
    }

}
