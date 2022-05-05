<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreatePlayer()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Cards\Player", $player);
    }

    /**
     * verify Player contains variables score, bust nad hand
     */
    public function testVariables()
    {
        $this->assertClassHasAttribute('score', Player::class);
        $this->assertClassHasAttribute('bust', Player::class);
        $this->assertClassHasAttribute('hand', Player::class);
    }

    /**
     * verify that the testNumberOfCards() returns correct property
     */
    public function testNumberOfCards()
    {
        $player = new Player();
        $test = ["1", "2", "3"];
        $player->addCards($test);
        $this->assertIsNumeric($player->numberOfCards());
        $this->assertEquals(3, $player->numberOfCards());
    }

    /**
     * verify that the getCards() returns correct property
     */
    public function testGetCards()
    {
        $player = new Player();
        $test = ["1", "2", "3"];
        $player->addCards($test);
        $this->assertIsArray($player->getCards());
        $this->assertEquals($test, $player->getCards());
    }

    /**
     * verify that the getBust() returns correct property
     */
    public function testGetBust()
    {
        $player = new Player();
        $this->assertIsBool($player->getBust());
    }

    /**
     * verify that the setBust() sets correct value
     * takes one argument
     */
    public function testSetBust()
    {
        $player = new Player();
        $bust = $player->getBust();
        $this->assertEquals($bust, false);
        $player->setBust(true);
        $this->assertEquals($player->getBust(), true);
    }

    /**
    * verify that the addCards() correctly adds to hand
    * takes one argument
    */
    public function testAddCards()
    {
        $player = new Player();
        $test = ["1", "2", "3"];
        $this->assertEmpty($player->getCards());
        $player->addCards($test);
        $this->assertNotEmpty($player->getCards());
    }

    /**
    * verify that the addScore() correctly adds to score
    * takes one argument
    */
    public function testAddScore()
    {
        $player = new Player();
        $test = 10;
        $this->assertEquals($player->getScore(), 0);
        $player->addScore($test);
        $this->assertEquals($player->getScore(), 10);
    }

    /**
    * verify that the getScore() returns correct value
    * takes no argument
    */
    public function testGetScore()
    {
        $player = new Player();
        $this->assertIsInt($player->getScore());
    }

    /**
    * verify that the resetScore() correctly resets score
    * takes no argument
    */
    public function testResetScore()
    {
        $player = new Player();
        $test = 10;
        $player->addScore($test);
        $this->assertEquals($player->getScore(), 10);
        $player->resetScore();
        $this->assertEquals($player->getScore(), 0);
    }
}
