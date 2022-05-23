<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Square.
 */
class SquareTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateGame()
    {
        $board = new Board();
        $deck = new Deck();
        $score = new Score();
        $game = new Square($deck, $board, $score);

        $this->assertInstanceOf("\App\Cards\Square", $game);
    }

    /**
     * verify Game contains variables board, score and deck
     */
    public function testVariables()
    {
        $this->assertClassHasAttribute('score', Square::class);
        $this->assertClassHasAttribute('deck', Square::class);
        $this->assertClassHasAttribute('board', Square::class);
    }

    /**
     * verify that the getDeck() returns correct property
     * , use no arguments.
     */
    public function testGetDeck()
    {
        $board = new Board();
        $deck = new Deck();
        $score = new Score();
        $game = new Square($deck, $board, $score);
        $test = $game->getDeck();
        $this->assertIsObject($test);
        $this->assertInstanceOf("\App\Cards\Deck", $test);
    }

    /**
     * verify that the getBoard() returns correct property
     * , use no arguments.
     */
    public function testGetBoard()
    {
        $board = new Board();
        $deck = new Deck();
        $score = new Score();
        $game = new Square($deck, $board, $score);
        $test = $game->getBoard();
        $this->assertIsObject($test);
        $this->assertInstanceOf("\App\Cards\Board", $test);
    }

    /**
     * verify that the getTotalScore() returns correct property
     * , use no arguments.
     */
    public function testGetTotalScore()
    {
        $board = new Board();
        $deck = new Deck();
        $score = new Score();
        $game = new Square($deck, $board, $score);
        $test = $game->getTotalScore();
        $this->assertIsInt($test);
        
    }

    /**
     * verify that the round() returns correct property
     * , use no arguments.
     */
    public function testRound()
    {
        $board = new Board();
        $deck = new Deck();
        $score = new Score();
        $game = new Square($deck, $board, $score);
        $card = $deck->draw();
        $id = 1;
        $test = $game->round($id, $card);
        $this->assertIsArray($test);
        $this->assertNotEquals($card, $test["card"]);
        $this->assertIsArray($test['board']);
    }

    /**
     * verify that the finnish() returns correct property and value
     * , use no arguments.
     */
    public function testFinnish()
    {

        $testArray = array(
            
            '1' => ["2♥" => 2],
            '2' => ["3♥" => 3],
            '3' => ["4♥" => 4],
            '4' => ["5♥" => 5],
            '5' => ["A♦" => 14],
            '6' => ["2♦" => 2],
            '7' => ["3♦" => 3],
            '8' => ["4♦" => 4],
            '9' => ["5♦" => 5],
            '10' => ["A♥" => 14],
            '11' => ["2♥" => 2],
            '12' => ["3♥" => 3],
            '13' => ["4♥" => 4],
            '14' => ["5♥" => 5],
            '15' => ["A♥" => 14],
            '16' => ["2♠" => 2],
            '17' => ["3♠" => 3],
            '18' => ["4♠" => 4],
            '19' => ["5♠" => 5],
            '20' => ["6♠" => 6],
            '21' => ["2♣" => 2],
            '22' => ["3♣" => 3],
            '23' => ["4♣" => 4],
            '24' => ["5♣" => 5],
            '25' => ["6♣" => 6]
        );
        $board = new Board();
        $deck = new Deck();
        $score = new Score();
        $game = new Square($deck, $board, $score);
        $testBoard = $game->getBoard();
        $preScore = $game->getTotalScore();

        foreach($testArray as $key=>$value) {
            $testBoard->setSlot($key, $value);
        };

        $scoreChart = $game->finnish();
        $newScore = $game->getTotalScore();
        $this->assertNotEquals($preScore, $newScore);
        $this->assertIsArray($scoreChart);
        $this->assertEquals($scoreChart["Straight"], 2);
        $this->assertEquals($scoreChart["Straight flush"], 3);
    }


}
