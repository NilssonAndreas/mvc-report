<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateGame()
    {
        $player = new Player();
        $deck = new Deck();
        $game = new Game($player, $deck);
        $this->assertInstanceOf("\App\Cards\Game", $game);
    }

    /**
     * verify Game contains variables player, bank and deck
     */
    public function testVariables()
    {
        $this->assertClassHasAttribute('bank', Game::class);
        $this->assertClassHasAttribute('deck', Game::class);
        $this->assertClassHasAttribute('player', Game::class);
    }

    /**
     * verify that the getPlayer() returns correct property
     * , use no arguments.
     */
    public function testGetPlayer()
    {
        $player = new Player();
        $deck = new Deck();
        $game = new Game($player, $deck);
        $test = $game->getPlayer();
        $this->assertIsObject($test);
    }

    /**
     * verify that the getDeck() returns correct property
     * , use no arguments.
     */
    public function testGetDeck()
    {
        $player = new Player();
        $deck = new Deck();
        $game = new Game($player, $deck);
        $test = $game->getDeck();
        $this->assertIsObject($test);
    }

    /**
    * verify that the setGameState() draws card. set score and check for bust
    * use no arguments.
    */
    public function testSetGameState()
    {
        $player = new Player();
        $deck = new Deck();
        $game = new Game($player, $deck);
        $theDeck = $game->getDeck();
        $test = $game->getPlayer();
        $oldScore = $test->getScore();
        $game->setGameState();
        $this->assertEquals($test->getBust(), false);
        $this->assertNotEquals($oldScore, $test->getScore());
        for ($i = 0; $i <= 12; $i++) {
            $game->setGameState();
        }
        $this->assertEquals($test->getBust(), true);
        $this->assertLessThan(52, $theDeck->countCards());
    }

    /**
    * verify that the endState() returns correct property
    * use no arguments.
    */
    public function testEndState()
    {
        $player = new Player();
        $deck = new Deck();
        $game = new Game($player, $deck);
        $end = $game->endState();
        $this->assertIsString($end);
    }
}
