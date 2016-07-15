<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation\Type;

class Binary extends SubjectResource
{
    const GET = 'getbinary';
    const UPDATE = 'setbinary';
    const DELETE = 'deletebinary';

    /**
     * @var string
     * @Type("string")
     */
    private $name;
    /**
     * @var string
     * @Type("string")
     */
    private $fn;
    /**
     * @var string
     * @Type("string")
     */
    private $title;
    /**
     * @var string
     * @Type("string")
     */
    private $description;
    /**
     * @var string
     * @Type("string")
     */
    private $modelId;
    /**
     * @var boolean
     * @Type("boolean")
     */
    private $authorNickname;
    /**
     * @var string
     * @Type("string")
     */
    private $authorId;

    public function getResource()
    {
        return parent::getResource() . '&name='.$this->name;
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
    public function getFn()
    {
        return $this->fn;
    }

    /**
     * @param string $fn
     */
    public function setFn($fn)
    {
        $this->fn = $fn;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * @param string $modelId
     */
    public function setModelId($modelId)
    {
        $this->modelId = $modelId;
    }

    /**
     * @return boolean
     */
    public function isAuthorNickname()
    {
        return $this->authorNickname;
    }

    /**
     * @param boolean $authorNickname
     */
    public function setAuthorNickname($authorNickname)
    {
        $this->authorNickname = $authorNickname;
    }

    /**
     * @return string
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param string $authorId
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }
}
