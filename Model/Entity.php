<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;



/**
 */
class Entity extends GenericResource implements BinaryContainingResource
{
    use WithBinaries;

    const RESOURCE = 'entities';

    const TYPE_SKETCHUP_MODEL = 'SKETCHUP_MODEL';
    const TYPE_TEKLA = 'TEKLA MODEL';

    const CONTENT_TYPE_3DW = '3dw';
    /**
     * @var string
     */
    private $premiumCollectionId;
    /**
     * @var User
     */
    private $modifier;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $externalUrl;
    /**
     * @var string
     */
    private $source;
    /**
     * @var boolean
     */
    private $isPrivate = false;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     * @TODO Enum?
     */
    private $type;
    /**
     * @var \DateTime
     */
    private $modifyTime;
    /**
     * @var integer
     */
    private $reviewCount;
    /**
     * @var integer
     */
    private $downloads;
    /**
     * @var integer
     */
    private $currentUserRating;
    /**
     * @var array
     */
    private $translations;
    /**
     * @var float
     */
    private $averageRating;
    /**
     * @var string
     */
    private $accessRole;
    /**
     * @var array
     */
    private $binaryNames;
    /**
     * @var string
     */
    private $contentType = Entity::CONTENT_TYPE_3DW;
    /**
     * @var integer
     */
    private $views;
    /**
     * @var User
     */
    private $creator;
    /**
     * @var array
     */
    private $tags;
    /**
     * @var boolean
     */
    private $isHidden = false;
    /**
     * @var integer
     */
    private $commentCount;
    /**
     * @var boolean
     */
    private $allowComments = true;
    /**
     * @var \DateTime
     */
    private $createTime;
    /**
     * @var string
     */
    private $parentCatalogId;
    /**
     * @var boolean
     */
    private $success;
    /**
     * @var array
     */
    private $attributes;
    /**
     * @var array
     */
    private $location;
    /**
     * @var array
     */
    private $binaries;

    public function extraAttributes($groups = [])
    {
        if (in_array('update', $groups)) {
            return [];
        }
        return [];
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
     * @return User
     */
    public function getModifier()
    {
        return $this->modifier;
    }

    /**
     * @param User $modifier
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
    public function getExternalUrl()
    {
        return $this->externalUrl;
    }

    /**
     * @param string $externalUrl
     */
    public function setExternalUrl($externalUrl)
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
    public function getDownloads()
    {
        return $this->downloads;
    }

    /**
     * @param int $downloads
     */
    public function setDownloads($downloads)
    {
        $this->downloads = $downloads;
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
     * @return string
     */
    public function getAccessRole()
    {
        return $this->accessRole;
    }

    /**
     * @param string $accessRole
     */
    public function setAccessRole($accessRole)
    {
        $this->accessRole = $accessRole;
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
     * @return int
     */
    public function getViews()
    {
        return $this->views;
    }

    /**
     * @param int $views
     */
    public function setViews($views)
    {
        $this->views = $views;
    }

    /**
     * @return User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param User $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
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
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->success = $success;
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
     * @return array
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param array $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
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

    public function hasBinary($filename)
    {
        return in_array($filename, $this->binaryNames);
    }
}
