<?php

namespace Tests\AppBundle\Service;

use AppBundle\Entity\Dinosaur;
use AppBundle\Service\DinosaurLengthDeterminator;
use PHPUnit\Framework\TestCase;

class DinosaurLengthDeterminatorTest extends TestCase
{
    /**
     * @param $spec
     * @param $minExpectedSize
     * @param $maxExpectedSize
     * @dataProvider getExpectedLengthTests
     */
    public function testItReturnsCorrectLengthRange($spec, $minExpectedSize, $maxExpectedSize)
    {
        $determinator = new DinosaurLengthDeterminator();
        $actualSize = $determinator->getLengthFromSpecification($spec);

        $this->assertGreaterThanOrEqual($minExpectedSize, $actualSize);
        $this->assertLessThanOrEqual($maxExpectedSize, $actualSize);
    }

    public function getExpectedLengthTests()
    {
        return [
            // specification, minLength, maxLength
            ['large carnivorous dinosaur', Dinosaur::LARGE, Dinosaur::HUGE-1],
            'default response' => ['give me all the cookies!!!', 0, Dinosaur::LARGE-1],
            ['large herbivore', Dinosaur::LARGE, Dinosaur::HUGE-1],
            ['huge dinosaur', Dinosaur::HUGE, 100],
            ['huge dino', Dinosaur::HUGE, 100],
            ['huge', Dinosaur::HUGE, 100],
            ['OMG', Dinosaur::HUGE, 100],
        ];

    }
}