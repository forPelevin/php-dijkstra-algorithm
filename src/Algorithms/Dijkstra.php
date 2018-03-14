<?php

namespace Otus\Algorithms;

use Otus\Graph\Edge;
use Otus\Graph\Graph;
use Otus\Graph\Node;

class Dijkstra
{
    /**
     * Result of the Dijkstra's algorithm.
     *
     * @var
     */
    protected $result;

    /**
     * Find shortest path to the all nodes by the Dijkstra's algorithm.
     *
     * @param Graph $graph
     *
     * @return mixed
     */
    public function findShortestPaths(Graph $graph)
    {
        $this->prepareResult($graph);

        while ($node = $this->getNextNode($graph)) {
            $this->updateWeights($graph, $node);
            $graph->markAsPassed($node->getId());
        }

        return $this->result;
    }

    /**
     * @param Graph $graph
     *
     * @return mixed
     */
    protected function getNextNode(Graph $graph)
    {
        $nearestNodeId = false;

        /** @var Node $node */
        foreach ($graph->getNotPassedNodes() as $node) {
            if (!$this->hasNode($node->getId())) {
                continue;
            }

            if (false === $nearestNodeId) {
                $nearestNodeId = $node->getId();
            }

            if ($this->result[$node->getId()] < $this->result[$nearestNodeId]) {
                $nearestNodeId = $node->getId();
            }
        }

        if (false === $nearestNodeId) {
            return false;
        }

        return $graph->getNode($nearestNodeId);
    }

    /**
     * Update weights in the result.
     *
     * @param Graph $graph
     * @param Node $node
     */
    protected function updateWeights(Graph $graph, Node $node)
    {
        $edges = $graph->getOutgoingEdges($node);

        /** @var Edge $edge */
        foreach ($edges as $edge) {
            $weight = ($this->result[$node->getId()] ?? 0) + $edge->getWeight();
            $destinationNodeId = $edge->getDestinationNodeId();

            if (!$this->hasNode($destinationNodeId) || $weight < $this->result[$destinationNodeId]) {
                $this->result[$destinationNodeId] = $weight;
            }
        }
    }

    /**
     * Check the result has given node ID.
     *
     * @param $id
     *
     * @return bool
     */
    protected function hasNode($nodeId)
    {
        return isset($this->result[$nodeId]);
    }

    /**
     * @param Graph $graph
     */
    protected function prepareResult(Graph $graph)
    {
        $this->result = [];

        $this->updateWeights($graph, $graph->getFirstNode());
    }
}