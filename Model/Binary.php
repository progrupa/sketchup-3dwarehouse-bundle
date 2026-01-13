<?php

namespace Progrupa\Sketchup3DWarehouseBundle\Model;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

 * Class Binary
 * @package Progrupa\Sketchup3DWarehouseBundle\Model
class Binary extends SubjectResource implements MultipartResource
{
    const RESOURCE = 'binaries';

    /**
     * @var string

     */
    private $name;
    
    /**
     * @var string
     */
    #[SerializedName('fn')]
    #[Groups(['get'])]
    private $downloadFilename;
    
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $contentUrl;
    /**
     * @var string
     */
    private $modelId;
    /**
     * @var boolean
     */
    private $authorNickname;
    /**
     * @var string
     */
    private $authorId;
    
    /**
     * @var string
     */
    #[Groups(['update'])]
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
