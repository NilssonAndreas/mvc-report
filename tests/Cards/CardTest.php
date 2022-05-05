<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class CardTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateCard()
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Cards\Card", $card);
        $set = $card->getSet();
        $this->assertNotEmpty($set);
        $suit = $card->getSuits();
        $this->assertNotEmpty($suit);
        $rank = $card->getRanks();
        $this->assertNotEmpty($rank);
    }
}
