<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Deck.
 */
class DeckTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDeck()
    {
        $deck = new Deck();
        $this->assertInstanceOf("\App\Cards\Deck", $deck);
    }

    /**
     * verify that the get() returns the right
     * properties, use no arguments.
     */
    public function testGet()
    {
        $deck = new Deck();
        $test = $deck->get();
        $this->assertIsArray($test);
    }

    /**
     * verify that the shuffle() does not return same as before
     * , use no arguments.
     */
    public function testShuffle()
    {
        $deck = new Deck();
        $test = $deck->get();
        $deck->shuffleDeck();
        $shuffled = $deck->get();
        $this->assertNotEquals(array_keys($test), array_keys($shuffled));
    }

    /**
    * verify that the draw() returns correct value, and removes from array
    * use no arguments.
    */
    public function testDraw()
    {
        $deck = new Deck();
        $draw = $deck->draw();
        $this->assertIsArray($draw);
        $pre = $deck->get();
        $deck->draw();
        $after = $deck->get();
        $this->assertLessThan(count($pre), count($after));
    }

    /**
    * verify that the countCards() returns correct value
    * use no arguments.
    */
    public function testCountCards()
    {
        $deck = new Deck();
        $count = $deck->countCards();
        $this->assertIsInt($count);
    }
}
