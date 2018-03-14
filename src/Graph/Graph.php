<?php

namespace Otus\Graph;

class Graph
{
    /**
     * Array of the graph's nodes
     *
     * @var array
     */
    protected $nodes = [];

    /**
     * @var array
     */
    protected $edges = [];

    /**
     * Set nodes.
     *
     * @param mixed $nodes
     */
    public function setNodes(array $nodes)
    {
        $this->nodes = $nodes;

        return $this;
    }

    /**
     * Add a new node to the graph's nodes.
     *
     * @param int $node
     *
     * @return $this
     */
    public function addNode(node $node)
    {
        $this->nodes[] = $node;

        return $this;
    }

    /**
     * Remove node from the graph by given ID.
     *
     * @param int $nodeId
     *
     * @return $this
     */
    public function removeNode(int $nodeId)
    {
        $this->nodes = array_filter($this->nodes, function ($node) use ($nodeId) {
            return $node->getId() !== $nodeId;
        });

        return $this;
    }

    /**
     * Mark node as passed.
     *
     * @param int $nodeId
     *
     * @return $this
     */
    public function markAsPassed(int $nodeId)
    {
        foreach ($this->nodes as $node) {
            if ($node->getId() === $nodeId) {
                $node->markPassed();
            }
        }

        return $this;
    }

    /**
     * Get only not passed nodes.
     *
     * @return array
     */
    public function getNotPassedNodes()
    {
        return array_filter($this->nodes, function ($node) {
            return !$node->isPassed();
        });
    }

    /**
     * Get node of the graph by ID.
     *
     * @param int $nodeId
     *
     * @return mixed
     */
    public function getNode(int $nodeId)
    {
        return array_values(array_filter($this->nodes, function ($node) use ($nodeId) {
                return $node->getId() === $nodeId;
            }))[0] ?? null;
    }

    /**
     * Get nodes of the graph.
     *
     * @return array
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * Get first node of the graph.
     *
     * @return mixed|null
     */
    public function getFirstNode()
    {
        return reset($this->nodes) ?? null;
    }

    /**
     * @param array $edges
     *
     * @return Graph
     */
    public function setEdges(array $edges): Graph
    {
        $this->edges = $edges;

        return $this;
    }

    /**
     * @return array
     */
    public function getEdges(): array
    {
        return $this->edges;
    }

    /**
     * @param Node $node
     *
     * @return array
     */
    public function getOutgoingEdges(Node $node): array
    {
        return array_values(array_filter($this->edges, function ($edge) use ($node) {
            return $edge->getStartNodeId() === $node->getId();
        }));
    }
}