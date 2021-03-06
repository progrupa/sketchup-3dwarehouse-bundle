<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Class Binary
 * @package Progrupa\Sketchup3DWarehouseBundle\Model
 * @Serializer\ExclusionPolicy("all")
 */
class Binary extends SubjectResource implements MultipartResource
{
    const RESOURCE = 'binaries';

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose
     */
    private $name;
    /**
     * @var string
     * @Serializer\Type("string")
     * @SerializedName("fn")
     * @Groups({"get"})
     */
    private $downloadFilename;
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
     * @Serializer\Expose
     */
    private $contentUrl;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $modelId;
    /**
     * @var boolean
     * @Serializer\Type("Su3DWBoolean")
     */
    private $authorNickname;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $authorId;
    /**
     * @var string
     * @Serializer\Type("string")
     * @Groups("update")
     */
    private $types;

    /**
     * @var resource
     */
    private $file;

    public function extraAttributes($groups = [])
    {
        return [
//            'binary' => fopen($this->file, 'r'),
//            'md5hash' => md5(file_get_contents($this->file)),
//            'task' => 'NEWMODEL',
//            'priority' => 50,
        ];
    }

    public function file()
    {
        return $this->getFile();
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
    public function getDownloadFilename()
    {
        return $this->downloadFilename;
    }

    /**
     * @param string $downloadFilename
     */
    public function setDownloadFilename($downloadFilename)
    {
        $this->downloadFilename = $downloadFilename;
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
    public function getContentUrl()
    {
        return $this->contentUrl;
    }

    /**
     * @param string $contentUrl
     */
    public function setContentUrl(string $contentUrl)
    {
        $this->contentUrl = $contentUrl;
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

    /**
     * @return resource
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param resource $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return string
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * @param string $types
     */
    public function setTypes($types)
    {
        $this->types = $types;
    }
}
