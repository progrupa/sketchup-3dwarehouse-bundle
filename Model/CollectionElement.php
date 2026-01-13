<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;



class CollectionElement extends GenericRelation implements WarehouseRelation
{
    const RESOURCE = 'collections';

    /**
     * @var string
     */
    private $parentCollectionId;
    /**
     * @var string
     */
    private $childClass;
    /**
     * @var string
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

    public function getResource()
    {
        return sprintf("%s/%s/%s",
            self::RESOURCE,
            $this->getParentCollectionId(),
            $this->getChildClass()
        );
    }

    public function getParameters()
    {
        return [
            'childIds' => [$this->getChildId()]
        ];
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
