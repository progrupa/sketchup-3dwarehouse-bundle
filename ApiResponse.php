<?php

namespace Progrupa\Sketchup3DWarehouseBundle;

use Symfony\Component\Serializer\Annotation\SerializedName;

class ApiResponse
{
    private $code;
    private $success;
    
    /**
     * @SerializedName("errorId")
     */
    private $errorId;
    
    /**
     * @SerializedName("errorList")
     */
    private $errorList;
    
    private $cause;
    private $message;
    private $entity;
    private $createdLocation;

    /**
     * @param integer $code
     * @param bool $success
     * @param string $errorId
     * @param string $message
     */
    public function __construct($code, $success = true, $errorId = '', $message = '')
    {
        $this->code = $code;
        $this->success = $success;
        $this->errorId = $errorId;
        $this->message = $message;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode($code)
    {
        $this->code = $code;
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
     * @return string
     */
    public function getErrorId()
    {
        return $this->errorId;
    }

    /**
     * @param string $errorId
     */
    public function setErrorId($errorId)
    {
        $this->errorId = $errorId;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return Resource
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param Resource $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return string|null
     */
    public function getCreatedLocation()
    {
        return $this->createdLocation;
    }

    /**
     * @param string|null $createdLocation
     */
    public function setCreatedLocation($createdLocation)
    {
        $this->createdLocation = $createdLocation;
    }

    /**
     * @return string
     */
    public function getErrorList()
    {
        return $this->errorList;
    }

    /**
     * @param array|string|null $errorList
     */
    public function setErrorList($errorList)
    {
        $this->errorList = $errorList;
    }

    /**
     * @return string|null
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * @param string|null $cause
     */
    public function setCause($cause)
    {
        $this->cause = $cause;
    }
}
