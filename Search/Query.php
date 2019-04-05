<?php
namespace Progrupa\Sketchup3DWarehouseBundle\Search;

use JMS\Serializer\Annotation as Serializer;

class Query
{

    const CLASS_COLLECTION = 'collection';
    const CLASS_ENTITY = 'entity';
    const CLASS_ITEM = 'item';
    const CLASS_PACKAGE = 'package';
    const CLASS_COLLECTION_OR_ENTITY = 'collectionorentity';
    const CLASS_ALL = 'all';

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $class;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $q;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $createUserId;

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    public function setClass(string $class)
    {
        $this->class = $class;
    }

    /**
     * @return string
     */
    public function getQ()
    {
        return $this->q;
    }

    /**
     * @param string $q
     */
    public function setQ(string $q)
    {
        $this->q = $q;
    }

    /**
     * @return string
     */
    public function getCreateUserId(): string
    {
        return $this->createUserId;
    }

    /**
     * @param string $createUserId
     */
    public function setCreateUserId(string $createUserId): void
    {
        $this->createUserId = $createUserId;
    }
}