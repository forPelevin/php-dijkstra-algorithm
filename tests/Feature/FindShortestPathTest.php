<?php

namespace Tests\Feature;

use PHPUnit\Framework\TestCase;

class FindShortestPathTest extends TestCase
{
    /** @test */
    public function a_user_can_get_shortest_path_for_the_given_graph()
    {
        exec('./bin/console path:find ./matrix.example.json', $output);

        $result = [
            "Shortest paths to the all nodes. Format: 'Node ID' => 'Path length'",
            '2 => 15',
            '3 => 13',
            '4 => 10',
            '5 => 18'
        ];

        $this->assertEquals($result, $output);
    }

    /** @test */
    public function a_valid_json_file_must_be_provided()
    {
        exec('./bin/console path:find ./matrix', $noFileOutput);

        $this->assertContains('There is no file', $noFileOutput[0]);

        exec('./bin/console path:find ./bin/console', $badFormatOutput);

        $this->assertContains('must be JSON formatted', $badFormatOutput[0]);
    }
}