<?php

use Otus\Graph\Edge;
use Otus\Graph\Graph;
use Otus\Graph\Node;
use PHPUnit\Framework\TestCase;

class GraphTest extends TestCase
{
    /** @test */
    public function it_can_manage_its_nodes()
    {
        $node = (new Node())->setId(0);

        $graph = new Graph();

        $graph->addNode($node);

        $this->assertContains($node, $graph->getNodes());

        $graph->removeNode(0);

        $this->assertNotContains($node, $graph->getNodes());
    }

    /** @test */
    public function it_can_fetch_first_node_from_the_nodes()
    {
        $graph = new Graph();

        $nodes = ['node1', 'node2'];

        $graph->setNodes($nodes);

        $this->assertEquals('node1', $graph->getFirstNode());
    }

    /** @test */
    public function it_can_mark_its_nodes_as_passed()
    {
        $nodeId = 1;
        $node = (new Node())->setId($nodeId);

        $graph = new Graph();
        $graph->addNode($node)->markAsPassed($nodeId);

        $this->assertTrue($graph->getFirstNode()->isPassed());
    }

    /** @test */
    public function it_can_get_outgoing_edges_from_the_given_node()
    {
        $edges = [
            (new Edge())->setStartNodeId(1),
            (new Edge())->setStartNodeId(2),
            (new Edge())->setStartNodeId(3),
        ];

        $node = (new Node())->setId(2);

        $graph = new Graph();
        $graph->setEdges($edges);

        $outgoingEdges = $graph->getOutgoingEdges($node);

        $this->assertCount(1, $outgoingEdges);
        $this->assertEquals((new Edge())->setStartNodeId(2), $outgoingEdges[0]);
    }
}