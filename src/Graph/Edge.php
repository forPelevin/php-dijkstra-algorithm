<?php

namespace Otus\Graph;

class Edge
{
    /**
     * @var
     */
    protected $id;

    /**
     * @var int
     */
    protected $startNodeId;

    /**
     * @var int
     */
    protected $destinationNodeId;

    /**
     * @var int
     */
    protected $weight;

    /**
     * @param mixed $startNodeId
     *
     * @return Edge
     */
    public function setStartNodeId($startNodeId)
    {
        $this->startNodeId = $startNodeId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getStartNodeId()
    {
        return $this->startNodeId;
    }

    /**
     * @param mixed $destinationNodeId
     *
     * @return Edge
     */
    public function setDestinationNodeId($destinationNodeId)
    {
        $this->destinationNodeId = $destinationNodeId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDestinationNodeId()
    {
        return $this->destinationNodeId;
    }

    /**
     * @param mixed $weight
     *
     * @return Edge
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $id
     *
     * @return Edge
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}