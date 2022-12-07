<?php

namespace Tests\Feature;

use App\Answers\Feat2\SequenceFilter;
use Tests\TestCase;

class SequenceFilterTest extends TestCase
{
    public function testWithoutSequence()
    {
        $sum = (new SequenceFilter())->getSumForLimit(5);
        $expectedSum = ((5 + 1) * 5 / 2);
        $this->assertEquals($expectedSum, $sum);
    }

    public function testWithSequence()
    {
        $sum = (new SequenceFilter())->getSumForLimit(123);
        $expectedSum = ((123 + 1) * 123 / 2) - 123;
        $this->assertEquals($expectedSum, $sum);
    }

    public function testAnswer()
    {
        $this->assertGreaterThan(0, SequenceFilter::getAnswer());
    }
}
