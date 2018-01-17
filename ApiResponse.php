<?php

namespace Progrupa\Sketchup3DWarehouseBundle;


use JMS\Serializer\Annotation as Serializer;

class ApiResponse
{
    /** @var integer */
    private $code;
    /**
     * @var boolean
     * @Serializer\Type("boolean")
     */
    private $success;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $id;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $errorId;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $message;
    /**
     * @var Resource
     */
    private $entity;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
}
