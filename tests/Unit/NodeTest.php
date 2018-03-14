<?php

use Otus\Graph\Node;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{

    /** @test */
    public function it_can_mark_itself_as_passed()
    {
        $node = new node();

        $this->assertFalse($node->isPassed());

        $node->markPassed();

        $this->assertTrue($node->isPassed());
    }
}