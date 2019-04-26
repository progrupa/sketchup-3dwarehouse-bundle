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
    private $type;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $externalUrl;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $source;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $title;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $description;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $sortBy;
    /**
     * @var string
     * @Serializer\Type("integer")
     */
    private $startRow;
    /**
     * @var string
     * @Serializer\Type("integer")
     */
    private $endRow;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $containsId;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $parentCollectionId;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $parentCatalogId;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $createUserDisplayName;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $createUserId;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $modifyUserDisplayName;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $id;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $excludeId;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $reviewedByUser;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $reviewCount;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $fq;

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
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getExternalUrl()
    {
        return $this->externalUrl;
    }

    /**
     * @param string $externalUrl
     */
    public function setExternalUrl(string $externalUrl)
    {
        $this->externalUrl = $externalUrl;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource(string $source)
    {
        $this->source = $source;
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
    public function setTitle(string $title)
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
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getSortBy()
    {
        return $this->sortBy;
    }

    /**
     * @param string $sortBy
     */
    public function setSortBy(string $sortBy)
    {
        $this->sortBy = $sortBy;
    }

    /**
     * @return string
     */
    public function getStartRow()
    {
        return $this->startRow;
    }

    /**
     * @param string $startRow
     */
    public function setStartRow(string $startRow)
    {
        $this->startRow = $startRow;
    }

    /**
     * @return string
     */
    public function getEndRow()
    {
        return $this->endRow;
    }

    /**
     * @param string $endRow
     */
    public function setEndRow(string $endRow)
    {
        $this->endRow = $endRow;
    }

    /**
     * @return string
     */
    public function getContainsId()
    {
        return $this->containsId;
    }

    /**
     * @param string $containsId
     */
    public function setContainsId(string $containsId)
    {
        $this->containsId = $containsId;
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
    public function setParentCollectionId(string $parentCollectionId)
    {
        $this->parentCollectionId = $parentCollectionId;
    }

    /**
     * @return string
     */
    public function getParentCatalogId()
    {
        return $this->parentCatalogId;
    }

    /**
     * @param string $parentCatalogId
     */
    public function setParentCatalogId(string $parentCatalogId)
    {
        $this->parentCatalogId = $parentCatalogId;
    }

    /**
     * @return string
     */
    public function getCreateUserDisplayName()
    {
        return $this->createUserDisplayName;
    }

    /**
     * @param string $createUserDisplayName
     */
    public function setCreateUserDisplayName(string $createUserDisplayName)
    {
        $this->createUserDisplayName = $createUserDisplayName;
    }

    /**
     * @return string
     */
    public function getCreateUserId()
    {
        return $this->createUserId;
    }

    /**
     * @param string $createUserId
     */
    public function setCreateUserId(string $createUserId)
    {
        $this->createUserId = $createUserId;
    }

    /**
     * @return string
     */
    public function getModifyUserDisplayName()
    {
        return $this->modifyUserDisplayName;
    }

    /**
     * @param string $modifyUserDisplayName
     */
    public function setModifyUserDisplayName(string $modifyUserDisplayName)
    {
        $this->modifyUserDisplayName = $modifyUserDisplayName;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getExcludeId()
    {
        return $this->excludeId;
    }

    /**
     * @param string $excludeId
     */
    public function setExcludeId(string $excludeId)
    {
        $this->excludeId = $excludeId;
    }

    /**
     * @return string
     */
    public function getReviewedByUser()
    {
        return $this->reviewedByUser;
    }

    /**
     * @param string $reviewedByUser
     */
    public function setReviewedByUser(string $reviewedByUser)
    {
        $this->reviewedByUser = $reviewedByUser;
    }

    /**
     * @return string
     */
    public function getReviewCount()
    {
        return $this->reviewCount;
    }

    /**
     * @param string $reviewCount
     */
    public function setReviewCount(string $reviewCount)
    {
        $this->reviewCount = $reviewCount;
    }

    /**
     * @return string
     */
    public function getFq()
    {
        return $this->fq;
    }

    /**
     * @param string $fq
     */
    public function setFq(string $fq)
    {
        $this->fq = $fq;
    }
}