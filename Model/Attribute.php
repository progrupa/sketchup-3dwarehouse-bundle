<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation as Serializer;

class Attribute extends SubjectResource
{
    const RESOURCE = 'attributes';

    const DATA_INT = 'int';
    const DATA_FLOAT = 'float';
    const DATA_STRING = 'string';
    const DATA_BOOLEAN = 'boolean';

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $category;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $name;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $value;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $dataType;
    /**
     * @var boolean
     * @Serializer\Type("Su3DWBoolean")
     */
    private $doNotNotify;

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * @param string $dataType
     */
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;
    }

    /**
     * @return boolean
     */
    public function isDoNotNotify()
    {
        return $this->doNotNotify;
    }

    /**
     * @param boolean $doNotNotify
     */
    public function setDoNotNotify($doNotNotify)
    {
        $this->doNotNotify = $doNotNotify;
    }
}
