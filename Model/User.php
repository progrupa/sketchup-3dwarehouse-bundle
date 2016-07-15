<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation\Type;

class User extends GenericResource
{
    const GET = 'getuser';
    const UPDATE = 'setuser';
    const DELETE = 'deleteuser';

    /**
     * @var boolean
     * @Type("boolean")
     */
    private $canContactUser;
    /**
     * @var boolean
     * @Type("boolean")
     */
    private $isVerified;
    /**
     * @var string
     * @Type("string")
     */
    private $displayName;
    /**
     * @var SimpleUserProjection
     * @Type("Progrupa\Sketchup3DWarehouseBundle\Model\SimpleUserProjection")
     */
    private $modifier;
    /**
     * @var array
     * @Type("array")
     */
    private $roles;
    /**
     * @var string
     * @Type("string")
     */
    private $language;
    /**
     * @var string
     * @Type("string")
     */
    private $authProvider;
    /**
     * @var string
     * @Type("string")
     */
    private $emailAddress;
    /**
     * @var \DateTime
     * @Type("DateTime<'Y-m-d H:i:s+'>")
     */
    private $modifyTime;
    /**
     * @var string
     * @Type("string")
     */
    private $externalResourceType;
    /**
     * @var string
     * @Type("string")
     */
    private $customWarehouseUrl;
    /**
     * @var SimpleUserProjection
     * @Type("Progrupa\Sketchup3DWarehouseBundle\Model\SimpleUserProjection")
     */
    private $creator;
    /**
     * @var string
     * @Type("string")
     */
    private $externalId;
    /**
     * @var string
     * @Type("string")
     */
    private $picture;
    /**
     * @var integer
     * @Type("integer")
     */
    private $commentCount;
    /**
     * @var string
     * @Type("string")
     */
    private $masterId;
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
     * @var string
     * @Type("string")
     */
    private $trimbleId;
    /**
     * @var array
     * @Type("array")
     */
    private $binaries;
    /**
     * @var array
     * @Type("array")
     */
    private $notifications;


    /** @return array */
    public function attributes()
    {
        return [];
    }

    /**
     * @return boolean
     */
    public function isCanContactUser()
    {
        return $this->canContactUser;
    }

    /**
     * @param boolean $canContactUser
     */
    public function setCanContactUser($canContactUser)
    {
        $this->canContactUser = $canContactUser;
    }

    /**
     * @return boolean
     */
    public function isIsVerified()
    {
        return $this->isVerified;
    }

    /**
     * @param boolean $isVerified
     */
    public function setIsVerified($isVerified)
    {
        $this->isVerified = $isVerified;
    }

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param string $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
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
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * @param array $roles
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;
    }

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
    public function getAuthProvider()
    {
        return $this->authProvider;
    }

    /**
     * @param string $authProvider
     */
    public function setAuthProvider($authProvider)
    {
        $this->authProvider = $authProvider;
    }

    /**
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
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
     * @return string
     */
    public function getExternalResourceType()
    {
        return $this->externalResourceType;
    }

    /**
     * @param string $externalResourceType
     */
    public function setExternalResourceType($externalResourceType)
    {
        $this->externalResourceType = $externalResourceType;
    }

    /**
     * @return string
     */
    public function getCustomWarehouseUrl()
    {
        return $this->customWarehouseUrl;
    }

    /**
     * @param string $customWarehouseUrl
     */
    public function setCustomWarehouseUrl($customWarehouseUrl)
    {
        $this->customWarehouseUrl = $customWarehouseUrl;
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
     * @return string
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * @param string $externalId
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;
    }

    /**
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
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
     * @return string
     */
    public function getMasterId()
    {
        return $this->masterId;
    }

    /**
     * @param string $masterId
     */
    public function setMasterId($masterId)
    {
        $this->masterId = $masterId;
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
     * @return string
     */
    public function getTrimbleId()
    {
        return $this->trimbleId;
    }

    /**
     * @param string $trimbleId
     */
    public function setTrimbleId($trimbleId)
    {
        $this->trimbleId = $trimbleId;
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

    /**
     * @return array
     */
    public function getNotifications()
    {
        return $this->notifications;
    }

    /**
     * @param array $notifications
     */
    public function setNotifications($notifications)
    {
        $this->notifications = $notifications;
    }


}
