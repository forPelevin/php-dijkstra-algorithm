<?php

namespace Otus\Graph;

class Node
{
    /**
     * The node ID
     *
     * @var
     */
    protected $id;

    /**
     * Indicates whether the node is passed or not
     *
     * @var bool
     */
    protected $passed = false;

    /**
     * Gets the node ID
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets the node ID
     *
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Marks the node as passed
     *
     * @return $this
     */
    public function markPassed()
    {
        $this->passed = true;

        return $this;
    }

    /**
     * Checks if the node is passed
     *
     * @return bool
     */
    public function isPassed()
    {
        return $this->passed;
    }
}