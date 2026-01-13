<?php
namespace Progrupa\Sketchup3DWarehouseBundle\Search;

use Symfony\Component\Serializer\Annotation\Ignore;
use Progrupa\Sketchup3DWarehouseBundle\Model\Entity;

class Query
{
    const CLASS_COLLECTION = 'collections';
    const CLASS_ENTITY = 'entities';
    const CLASS_ITEM = 'items';
    const CLASS_PACKAGE = 'packages';

    const QUERY_ALLOW_COMMENTS = "allowComments";
    const QUERY_ALTITUDE = "altitude";
    const QUERY_ATTRIBUTE = "attribute:%s:%s:%s";
    const QUERY_BINARY_EXTS = "binaryExts";
    const QUERY_BINARIES_JOBS_RESULTCODE = "binaries.jobs.%s.resultCode";
    const QUERY_BINARIES_JOBS_STATUS = "binaries.jobs.%s.status";
    const QUERY_BINARYNAMES = "binaryNames";
    const QUERY_COPYRIGHT = "copyright";
    const QUERY_CREATETIME = "createTime";
    const QUERY_CREATOR_DISPLAY_NAME = "creator.displayName";
    const QUERY_CREATOR_EXTERNAL_RESOURCE_TYPE = "creator.externalResourceType";
    const QUERY_CREATOR_ID = "creator.id";
    const QUERY_CREATOR_IS_VERIFIED = "creator.isVerified";
    const QUERY_DOWNLOADS = "downloads";
    const QUERY_EM_MATERIALS = "emMaterials";
    const QUERY_EXTERNAL_ID = "externalId";
    const QUERY_EXTERNAL_URL = "externalUrl";
    const QUERY_ID = "id";
    const QUERY_IS_HIDDEN = "isHidden";
    const QUERY_IS_PRIVATE = "isPrivate";
    const QUERY_LARGEST_BINARY_SIZE = "largestBinarySize";
    const QUERY_LATITUDE = "latitude";
    const QUERY_LONGITUDE = "longitude";
    const QUERY_MODIFIER_ID = "modifierId";
    const QUERY_MODIFIER_NAME = "modifierName";
    const QUERY_MODIFY_TIME = "modifyTime";
    const QUERY_OWNED_PARENT_IDS = "ownedParentIds";
    const QUERY_PARENT_IDS = "parentIds";
    const QUERY_POPULARITY = "popularity";
    const QUERY_REVIEW_COUNT = "reviewCount";
    const QUERY_REVIEWERS = "reviewers";
    const QUERY_SOURCE = "source";
    const QUERY_SUBTYPE = "subtype";
    const QUERY_TAGS = "tags";
    const QUERY_TITLE = "title";
    const QUERY_TYPE = "type";
    const QUERY_VIEWS = "views";

    #[Ignore]
    private $class;

    private $q;
    private $contentType = Entity::CONTENT_TYPE_3DW;
    private $sortBy;
    private $offset;
    private $count;
    private $fq = [];

    /**
     * @return string
     */
    public function getClass(): string
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
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    public function setContentType(string $contentType): void
    {
        $this->contentType = $contentType;
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
    public function getOffset()
    {
        return $this->offset;
    }

    /**
     * @param string $offset
     */
    public function setOffset(string $offset)
    {
        $this->offset = $offset;
    }

    /**
     * @return string
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param string $count
     */
    public function setCount(string $count)
    {
        $this->count = $count;
    }

    /**
     * @return string
     */
    public function getFq()
    {
        return $this->fq;
    }

    /**
     * @param array $fq
     */
    public function setFq(array $fq)
    {
        $this->fq = $fq;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addtoFq($key, $value)
    {
        $this->fq[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function getFromFq($key)
    {
        return array_key_exists($key, $this->fq) ? $this->fq[$key] : null;
    }

    //  FQ parameter setters

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->addtoFq(self::QUERY_TYPE, $type);
    }

    /**
     * @param string $externalUrl
     */
    public function setExternalUrl(string $externalUrl)
    {
        $this->addtoFq(self::QUERY_EXTERNAL_URL, $externalUrl);
    }

    /**
     * @param string $source
     */
    public function setSource(string $source)
    {
        $this->addtoFq(self::QUERY_SOURCE, $source);
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->addtoFq(self::QUERY_TITLE, $title);
    }

    /**
     * @param string $containsId
     */
    public function setContainsId(string $containsId)
    {
        $this->containsId = $containsId;
    }

    /**
     * @param string $parentCollectionId
     */
    public function setParentCollectionId(string $parentCollectionId)
    {
        $this->parentCollectionId = $parentCollectionId;
    }

    /**
     * @param string $parentCatalogId
     */
    public function setParentCatalogId(string $parentCatalogId)
    {
        $this->parentCatalogId = $parentCatalogId;
    }

    /**
     * @param string $createUserDisplayName
     */
    public function setCreateUserDisplayName(string $createUserDisplayName)
    {
        $this->addtoFq(self::QUERY_CREATOR_DISPLAY_NAME, $createUserDisplayName);
    }

    /**
     * @param string $createUserId
     */
    public function setCreateUserId(string $createUserId)
    {
        $this->addtoFq(self::QUERY_CREATOR_ID, $createUserId);
    }

    /**
     * @param string $modifierName
     */
    public function setModifierName(string $modifierName)
    {
        $this->addtoFq(self::QUERY_MODIFIER_NAME, $modifierName);
    }

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->addtoFq(self::QUERY_ID, $id);
    }

    /**
     * @param string $excludeId
     */
    public function setExcludeId(string $excludeId)
    {
        $this->excludeId = $excludeId;
    }

    /**
     * @param string $reviewedByUser
     */
    public function setReviewedByUser(string $reviewedByUser)
    {
        $this->reviewedByUser = $reviewedByUser;
    }

    /**
     * @param string $reviewCount
     */
    public function setReviewCount(string $reviewCount)
    {
        $this->addtoFq(self::QUERY_REVIEW_COUNT, $reviewCount);
    }
}