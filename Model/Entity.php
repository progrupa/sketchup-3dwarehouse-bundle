<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 */
class Entity extends GenericResource
{
    const GET = 'getentity';
    const UPDATE = 'setentity';
    const DELETE = 'deleteentity';

    const TYPE_SKETCHUP = 'SKETCHUP';
    const TYPE_TEKLA = 'TEKLA MODEL';
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $premiumCollectionId;
    /**
     * @var User
     * @Serializer\Type("Progrupa\Sketchup3DWarehouseBundle\Model\SimpleUserProjection")
     */
    private $modifier;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose
     */
    private $description;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose
     */
    private $externalUrl;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose
     */
    private $source;
    /**
     * @var boolean
     * @Serializer\Type("Su3DWBoolean")
     * @Serializer\Expose
     */
    private $isPrivate = false;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose
     */
    private $title;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose
     * @TODO Enum?
     */
    private $type;
    /**
     * @var \DateTime
     * @Serializer\Type("DateTime<'Y-m-d H:i:s+'>")
     */
    private $modifyTime;
    /**
     * @var integer
     * @Serializer\Type("integer")
     */
    private $reviewCount;
    /**
     * @var integer
     * @Serializer\Type("integer")
     */
    private $downloads;
    /**
     * @var integer
     * @Serializer\Type("integer")
     */
    private $currentUserRating;
    /**
     * @var array
     * @Serializer\Type("array")
     */
    private $translations;
    /**
     * @var float
     * @Serializer\Type("float")
     */
    private $averageRating;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $accessRole;
    /**
     * @var array
     * @Serializer\Type("array<string>")
     */
    private $binaryNames;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose
     */
    private $contentType = "3dw";
    /**
     * @var integer
     * @Serializer\Type("integer")
     */
    private $views;
    /**
     * @var User
     * @Serializer\Type("Progrupa\Sketchup3DWarehouseBundle\Model\SimpleUserProjection")
     */
    private $creator;
    /**
     * @var array
     * @Serializer\Type("array")
     */
    private $tags;
    /**
     * @var boolean
     * @Serializer\Type("Su3DWBoolean")
     * @Serializer\Expose
     */
    private $isHidden = false;
    /**
     * @var integer
     * @Serializer\Type("integer")
     */
    private $commentCount;
    /**
     * @var boolean
     * @Serializer\Type("Su3DWBoolean")
     * @Serializer\Expose
     */
    private $allowComments = true;
    /**
     * @var \DateTime
     * @Serializer\Type("DateTime<'Y-m-d H:i:s+'>")
     */
    private $createTime;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $parentCatalogId;
    /**
     * @var boolean
     * @Serializer\Type("Su3DWBoolean")
     */
    private $success;
    /**
     * @var array
     * @Serializer\Type("array")
     */
    private $attributes;
    /**
     * @var array
     * @Serializer\Type("array")
     */
    private $location;
    /**
     * @var array
     * @Serializer\Type("array")
     */
    private $binaries;

    public function extraAttributes($groups = [])
    {
        if (in_array('update', $groups)) {
            return [
                'tags' => implode(',', $this->tags ? : []),
            ];
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
}
