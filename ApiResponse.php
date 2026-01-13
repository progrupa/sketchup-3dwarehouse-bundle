<?php

namespace Progrupa\Sketchup3DWarehouseBundle;



class ApiResponse
{
    /**
     * @var integer
     */
    private $code;
    /**
     * @var boolean
     */
    private $success;
    /**
     * @var string
     */
    private $errorId;
    /**
     * @var string
     */
    private $errorList;
    /**
     * @var string
     */
    private $cause;
    /**
     * @var string
     */
    private $message;
    /**
     * @var Resource
     */
    private $entity;
    /**
     * @var string
     */
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
     * @return string
     */
    public function getCreatedLocation()
    {
        return $this->createdLocation;
    }

    /**
     * @param string $createdLocation
     */
    public function setCreatedLocation(string $createdLocation)
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
     * @param string $errorList
     */
    public function setErrorList(string $errorList)
    {
        $this->errorList = $errorList;
    }

    /**
     * @return string
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * @param string $cause
     */
    public function setCause(string $cause)
    {
        $this->cause = $cause;
    }
}
