<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class DeckWith2Jokers.
 */
class JokerTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testJoker()
    {
        $joker = new DeckWith2Jokers();
        $this->assertInstanceOf("\App\Cards\DeckWith2Jokers", $joker);
    }

}