<?php

namespace Tests\Feature;

use App\Answers\Feat1\FibAdder;
use Tests\TestCase;

class FibAdderTest extends TestCase
{
    public function testNoNumbers()
    {
        $sum = (new FibAdder())->getFibSumForMatrix([]);
        $this->assertEquals(0, $sum);
    }

    public function testOneArray()
    {
        $sum = (new FibAdder())->getFibSumForMatrix([
            [1, 2, 5, 9]
        ]);
        $this->assertEquals(8, $sum);
    }

    public function testTwoArrays()
    {
        $sum = (new FibAdder())->getFibSumForMatrix([
            [1, 14, 21, 5], // 27
            [10, 8, 13, 9] // 21
        ]);
        $this->assertEquals(48, $sum);
    }

    public function testAnswer()
    {
        $sum = FibAdder::getAnswer();
        $this->assertGreaterThan(0, $sum);
    }
}
