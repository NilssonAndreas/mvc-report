<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Hand.
 */
class HandTest extends TestCase
{

    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateHand()
    {
        $hand = new Hand();
        $this->assertInstanceOf("\App\Cards\Hand", $hand);
    }

    /**
     * verify that the addCardToHand() inserts into hand, use one argument.
     */
    public function testAddCardToHand()
    {
        $hand = new Hand();
        $this->assertEmpty($hand->showHand());
        $hand->addCardToHand(["Test Card"]);
        $this->assertNotEmpty($hand->showHand());
    }

    /**
     * verify that the showHand() returns correct property
     */
    public function testShowHand()
    {
        $hand = new Hand();
        $test = ["A", "B", "C"];
        $this->assertEmpty($hand->showHand());
        $hand->addCardToHand($test);
        $this->assertEquals($test, $hand->showHand());
    }

    /**
    * verify that the clearHand() clears hand
    * use no arguments.
    */
    public function testClearHand()
    {
        $hand = new Hand();
        $test = ["A", "B", "C"];
        $hand->addCardToHand($test);
        $this->assertNotEmpty($hand->showHand());
        $hand->clearHand();
        $this->assertEmpty($hand->showHand());
    }

}