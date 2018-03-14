<?php

use Otus\Matrix\Matrix;
use PHPUnit\Framework\TestCase;

class MatrixTest extends TestCase
{
    /** @test */
    public function it_can_transpose_itself()
    {
        $rows = [
            [1, 2],
            [3, 4],
            [5, 6]
        ];

        $matrix = new Matrix();
        $matrix->setRows($rows);

        $this->assertEquals($rows, $matrix->getRows());

        $transposed = [
            [1, 3, 5],
            [2, 4, 6]
        ];

        $this->assertEquals($transposed, $matrix->transpose());
    }
    
    
    /** @test */
    public function it_can_determine_that_the_given_rows_have_invalid_format()
    {
        $this->expectException('InvalidArgumentException');

        $rows = [
            [1, 2, 3],
            'invalid row',
            [5, 6]
        ];

        $matrix = new Matrix();
        $matrix->setRows($rows);
        $matrix->check();
    }
}