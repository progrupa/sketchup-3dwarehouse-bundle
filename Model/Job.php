<?php


namespace Progrupa\Sketchup3DWarehouseBundle\Model;


use JMS\Serializer\Annotation as Serializer;

class Job extends GenericResource
{
    const RESOURCE = 'jobs';

    const STATUS_NOT_STARTED = 'NOT_STARTED';
    const STATUS_IN_PROGRESS = 'IN_PROGRESS';
    const STATUS_REVERTED = 'REVERTED';
    const STATUS_REVERTING = 'REVERTING';
    const STATUS_SUCCESS = 'SUCCESS';
    const STATUS_FAILURE = 'FAILURE';

    const JOB_TYPE_MASS_UPLOAD = 'MASS_UPLOAD';
    const JOB_TYPE_NEW_MODEL = 'NEW_MODEL';
    const JOB_TYPE_OWNERSHIP_TRANSFER = 'OWNERSHIP_TRANSFER';
    const JOB_TYPE_PRINTABLE_MODEL = 'PRINTABLE_MODEL';
    const JOB_TYPE_RENDER_BOT = 'RENDER_BOT';
    const JOB_TYPE_RERENDER = 'RERENDER';
    const JOB_TYPE_USER_DELETION = 'USER_DELETION';
    const JOB_TYPE_USER_MERGE = 'USER_MERGE';
    const JOB_TYPE_VIRUS_SCAN = 'VIRUS_SCAN';

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    private $subjectId;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    private $name;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    private $jobType;

    /**
     * @var string
     * @Serializer\Type("string")
     * @Serializer\Expose()
     */
    private $status;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $resultCode;

    /**
     * @var integer
     * @Serializer\Type("integer")
     * @Serializer\Expose()
     */
    private $progress;

    /**
     * @var \DateTime
     * @Serializer\Type("DateTime<'Y-m-d H:i:s+'>")
     */
    private $createTime;

    /**
     * @var \DateTime
     * @Serializer\Type("DateTime<'Y-m-d H:i:s+'>")
     */
    private $modifyTime;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $state;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $details;

    /**
     * Job constructor.
     * @param string $subjectId
     * @param string $name
     * @param string $jobType
     */
    public function __construct(WarehouseResource $subject, $name, $jobType)
    {
        $this->subjectId = $subject->getId();
        $this->name = $name;
        $this->jobType = $jobType;
        $this->status = self::STATUS_NOT_STARTED;
        $this->progress = 0;
    }

    /**
     * @return string
     */
    public function getSubjectId()
    {
        return $this->subjectId;
    }

    /**
     * @param string $subjectId
     */
    public function setSubjectId($subjectId)
    {
        $this->subjectId = $subjectId;
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
    public function getJobType()
    {
        return $this->jobType;
    }

    /**
     * @param string $jobType
     */
    public function setJobType($jobType)
    {
        $this->jobType = $jobType;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getResultCode()
    {
        return $this->resultCode;
    }

    /**
     * @param string $resultCode
     */
    public function setResultCode($resultCode)
    {
        $this->resultCode = $resultCode;
    }

    /**
     * @return int
     */
    public function getProgress()
    {
        return $this->progress;
    }

    /**
     * @param int $progress
     */
    public function setProgress($progress)
    {
        $this->progress = $progress;
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
    public function setCreateTime(\DateTime $createTime)
    {
        $this->createTime = $createTime;
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
    public function setModifyTime(\DateTime $modifyTime)
    {
        $this->modifyTime = $modifyTime;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param string $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }
}