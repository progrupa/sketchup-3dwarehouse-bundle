<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation\Type;

class Collection extends GenericResource implements HierarchicalResource
{
    const GET = 'getcollection';
    const UPDATE = 'setcollection';
    const DELETE = 'deletecollection';

    const ADD_CHILD = 'setcollectioncontains';

    /** @return string */
    public function addChildResource()
    {
        return static::ADD_CHILD;
    }

    /**
     * @param Resource $resource
     * @return array
     */
    public function addChildParameters(Resource $resource, $doNotNotify = false)
    {
        return [
            'parentCollectionId' => $this->getId(),
            'childId' => $resource->getId(),
            'childClass' => SubjectClass::fromResource($resource),
            'doNotNotify' => $doNotNotify,
        ];
    }

    /**
     * @var integer
     * @Type("integer")
     */
    private $deepEntityCount;
    /**
     * @var string
     * @Type("string")
     */
    private $premiumCollectionId;
    /**
     * @var SimpleUserProjection
     * @Type("Progrupa\Sketchup3DWarehouseBundle\Model\SimpleUserProjection")
     */
    private $modifier;
    /**
     * @var string
     * @Type("string")
     */
    private $description;
    /**
     * @var string
     * @Type("string")
     */
    private $source;
    /**
     * @var boolean
     * @Type("boolean")
     */
    private $isPrivate;
    /**
     * @var string
     * @Type("string")
     */
    private $type;
    /**
     * @var string
     * @Type("string")
     */
    private $title;
    /**
     * @var \DateTime
     * @Type("DateTime<'Y-m-d H:i:s+'>")
     */
    private $modifyTime;
    /**
     * @var integer
     * @Type("integer")
     */
    private $reviewCount;
    /**
     * @var integer
     * @Type("integer")
     */
    private $currentUserRating;
    /**
     * @var array
     * @Type("array")
     */
    private $translations;
    /**
     * @var float
     * @Type("float")
     */
    private $averageRating;
    /**
     * @var array
     * @Type("array")
     */
    private $binaryNames;
    /**
     * @var string
     * @Type("string")
     */
    private $contentType;
    /**
     * @var array
     * @Type("array")
     */
    private $editors;
    /**
     * @var boolean
     * @Type("boolean")
     */
    private $isCatalog;
    /**
     * @var SimpleUserProjection
     * @Type("Progrupa\Sketchup3DWarehouseBundle\Model\SimpleUserProjection")
     */
    private $creator;
    /**
     * @var integer
     * @Type("integer")
     */
    private $deepCollectionCount;
    /**
     * @var array
     * @Type("array")
     */
    private $tags;
    /**
     * @var boolean
     * @Type("boolean")
     */
    private $isHidden;
    /**
     * @var integer
     * @Type("integer")
     */
    private $commentCount;
    /**
     * @var boolean
     * @Type("boolean")
     */
    private $allowComments;
    /**
     * @var integer
     * @Type("integer")
     */
    private $entityCount;
    /**
     * @var \DateTime
     * @Type("DateTime<'Y-m-d H:i:s+'>")
     */
    private $createTime;
    /**
     * @var string
     * @Type("string")
     */
    private $parentCatalogId;
    /**
     * @var integer
     * @Type("integer")
     */
    private $collectionCount;
    /**
     * @var array
     * @Type("array")
     */
    private $attributes;
    /**
     * @var boolean
     * @Type("boolean")
     */
    private $isPremium;
    /**
     * @var array
     * @Type("array")
     */
    private $binaries;

    /** @return array */
    public function attributes()
    {
        return [];
    }

    /**
     * @return int
     */
    public function getDeepEntityCount()
    {
        return $this->deepEntityCount;
    }

    /**
     * @param int $deepEntityCount
     */
    public function setDeepEntityCount($deepEntityCount)
    {
        $this->deepEntityCount = $deepEntityCount;
    }

    /**
     * @return string
     */
    public function getPremiumCollectionId()
    {
        return $this->premiumCollectionId;
    }

    /**
     * @param string $premiumCollectionId
     */
    public function setPremiumCollectionId($premiumCollectionId)
    {
        $this->premiumCollectionId = $premiumCollectionId;
    }

    /**
     * @return SimpleUserProjection
     */
    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * @param SimpleUserProjection $modifier
     */
    public function setModifier($modifier)
    {
        $this->modifier = $modifier;
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
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    /**
     * @return boolean
     */
    public function isIsPrivate()
    {
        return $this->isPrivate;
    }

    /**
     * @param boolean $isPrivate
     */
    public function setIsPrivate($isPrivate)
    {
        $this->isPrivate = $isPrivate;
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
    public function setType($type)
    {
        $this->type = $type;
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
     * @return \DateTime
     */
    public function getModifyTime()
    {
        return $this->modifyTime;
    }

    /**
     * @param \DateTime $modifyTime
     */
    public function setModifyTime($modifyTime)
    {
        $this->modifyTime = $modifyTime;
    }

    /**
     * @return int
     */
    public function getReviewCount()
    {
        return $this->reviewCount;
    }

    /**
     * @param int $reviewCount
     */
    public function setReviewCount($reviewCount)
    {
        $this->reviewCount = $reviewCount;
    }

    /**
     * @return int
     */
    public function getCurrentUserRating()
    {
        return $this->currentUserRating;
    }

    /**
     * @param int $currentUserRating
     */
    public function setCurrentUserRating($currentUserRating)
    {
        $this->currentUserRating = $currentUserRating;
    }

    /**
     * @return array
     */
    public function getTranslations()
    {
        return $this->translations;
    }

    /**
     * @param array $translations
     */
    public function setTranslations($translations)
    {
        $this->translations = $translations;
    }

    /**
     * @return float
     */
    public function getAverageRating()
    {
        return $this->averageRating;
    }

    /**
     * @param float $averageRating
     */
    public function setAverageRating($averageRating)
    {
        $this->averageRating = $averageRating;
    }

    /**
     * @return array
     */
    public function getBinaryNames()
    {
        return $this->binaryNames;
    }

    /**
     * @param array $binaryNames
     */
    public function setBinaryNames($binaryNames)
    {
        $this->binaryNames = $binaryNames;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }

    /**
     * @return array
     */
    public function getEditors()
    {
        return $this->editors;
    }

    /**
     * @param array $editors
     */
    public function setEditors($editors)
    {
        $this->editors = $editors;
    }

    /**
     * @return boolean
     */
    public function isIsCatalog()
    {
        return $this->isCatalog;
    }

    /**
     * @param boolean $isCatalog
     */
    public function setIsCatalog($isCatalog)
    {
        $this->isCatalog = $isCatalog;
    }

    /**
     * @return SimpleUserProjection
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param SimpleUserProjection $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return int
     */
    public function getDeepCollectionCount()
    {
        return $this->deepCollectionCount;
    }

    /**
     * @param int $deepCollectionCount
     */
    public function setDeepCollectionCount($deepCollectionCount)
    {
        $this->deepCollectionCount = $deepCollectionCount;
    }

    /**
     * @return array
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return boolean
     */
    public function isIsHidden()
    {
        return $this->isHidden;
    }

    /**
     * @param boolean $isHidden
     */
    public function setIsHidden($isHidden)
    {
        $this->isHidden = $isHidden;
    }

    /**
     * @return int
     */
    public function getCommentCount()
    {
        return $this->commentCount;
    }

    /**
     * @param int $commentCount
     */
    public function setCommentCount($commentCount)
    {
        $this->commentCount = $commentCount;
    }

    /**
     * @return boolean
     */
    public function isAllowComments()
    {
        return $this->allowComments;
    }

    /**
     * @param boolean $allowComments
     */
    public function setAllowComments($allowComments)
    {
        $this->allowComments = $allowComments;
    }

    /**
     * @return int
     */
    public function getEntityCount()
    {
        return $this->entityCount;
    }

    /**
     * @param int $entityCount
     */
    public function setEntityCount($entityCount)
    {
        $this->entityCount = $entityCount;
    }

    /**
     * @return \DateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @param \DateTime $createTime
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;
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
    public function setParentCatalogId($parentCatalogId)
    {
        $this->parentCatalogId = $parentCatalogId;
    }

    /**
     * @return int
     */
    public function getCollectionCount()
    {
        return $this->collectionCount;
    }

    /**
     * @param int $collectionCount
     */
    public function setCollectionCount($collectionCount)
    {
        $this->collectionCount = $collectionCount;
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return boolean
     */
    public function isIsPremium()
    {
        return $this->isPremium;
    }

    /**
     * @param boolean $isPremium
     */
    public function setIsPremium($isPremium)
    {
        $this->isPremium = $isPremium;
    }

    /**
     * @return array
     */
    public function getBinaries()
    {
        return $this->binaries;
    }

    /**
     * @param array $binaries
     */
    public function setBinaries($binaries)
    {
        $this->binaries = $binaries;
    }
}
