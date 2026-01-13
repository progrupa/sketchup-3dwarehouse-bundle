<?php
namespace Progrupa\Sketchup3DWarehouseBundle\Search;

use Progrupa\Sketchup3DWarehouseBundle\Model\Collection;
use Progrupa\Sketchup3DWarehouseBundle\Model\Entity;
use Progrupa\Sketchup3DWarehouseBundle\Model\GenericResource;

class Result
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
    private $message;
    /**
     * @var integer
     */
    private $total;
    /**
     * @var integer
     */
    private $startRow;
    /**
     * @var integer
     */
    private $endRow;
    /**
     * @var array
     */
    private $entries;
    /** @var array|GenericResource[] */
    private $items = [];
    /** @var array|Entity[] */
    private $entities = [];
    /** @var array|Collection[] */
    private $collections = [];

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
    public function setCode(int $code)
    {
        $this->code = $code;
        $this->setSuccess($code == 200);
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->success;
    }

    /**
     * @param bool $success
     */
    public function setSuccess(bool $success)
    {
        $this->success = $success;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total)
    {
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getStartRow()
    {
        return $this->startRow;
    }

    /**
     * @param int $startRow
     */
    public function setStartRow(int $startRow)
    {
        $this->startRow = $startRow;
    }

    /**
     * @return int
     */
    public function getEndRow()
    {
        return $this->endRow;
    }

    /**
     * @param int $endRow
     */
    public function setEndRow(int $endRow)
    {
        $this->endRow = $endRow;
    }

    /**
     * @return array
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @param array $entries
     */
    public function setEntries(array $entries)
    {
        $this->entries = $entries;
    }

    /**
     * @return array|GenericResource[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array|GenericResource[] $entities
     */
    public function setItems($items)
    {
        $this->items = $entities;

        return $this;
    }

    /**
     * @param GenericResource $item
     */
    public function addItem($item)
    {
        $this->items[] = $item;
        if ($item instanceof Entity) {
            $this->entities[] = $item;
        } elseif ($item instanceof Collection) {
            $this->collections[] = $item;
        }

        return $this;
    }

    /**
     * @return array|Entity[]
     */
    public function getEntities()
    {
        return $this->entities;
    }

    /**
     * @return array|Collection[]
     */
    public function getCollections()
    {
        return $this->collections;
    }
}