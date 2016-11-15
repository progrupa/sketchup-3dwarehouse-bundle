<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation as Serializer;

class Translation extends SubjectResource
{
    const GET = 'gettranslation';
    const UPDATE = 'settranslation';
    const DELETE = 'deletetranslation';

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $language;
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
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
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
}
