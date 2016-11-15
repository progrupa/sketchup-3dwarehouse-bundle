<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation as Serializer;

class CollectionElement extends GenericRelation
{
    const UPDATE = 'setcollectioncontains';
    const DELETE = 'deletecollectioncontains';

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("parentCollectionId")
     */
    private $parentCollectionId;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("childClass")
     */
    private $childClass;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\SerializedName("childId")
     */
    private $childId;

    /**
     * CollectionElement constructor.
     * @param string $parentCollectionId
     * @param string $childClass
     * @param string $childId
     */
    public function __construct($parentCollectionId = null, $childId = null, $childClass = null)
    {
        $this->parentCollectionId = $parentCollectionId;
        $this->childId = $childId;
        $this->childClass = $childClass;
    }


    /**
     * @return string
     */
    public function getParentCollectionId()
    {
        return $this->parentCollectionId;
    }

    /**
     * @param string $parentCollectionId
     */
    public function setParentCollectionId($parentCollectionId)
    {
        $this->parentCollectionId = $parentCollectionId;
    }

    /**
     * @return string
     */
    public function getChildClass()
    {
        return $this->childClass;
    }

    /**
     * @param string $childClass
     */
    public function setChildClass($childClass)
    {
        $this->childClass = $childClass;
    }

    /**
     * @return string
     */
    public function getChildId()
    {
        return $this->childId;
    }

    /**
     * @param string $childId
     */
    public function setChildId($childId)
    {
        $this->childId = $childId;
    }
}
