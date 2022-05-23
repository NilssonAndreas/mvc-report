<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Square.
 */
class ScoreTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateScore()
    {
        $score = new Score();
    
        $this->assertInstanceOf("\App\Cards\Score", $score);
    }

    /**
     * verify Score contains variables scoreChart, score, scoreFrequency, straight, suits and hands
     */
    public function testVariables()
    {
        $this->assertClassHasAttribute('score', Score::class);
        $this->assertClassHasAttribute('scoreChart', Score::class);
        $this->assertClassHasAttribute('hands', Score::class);
        $this->assertClassHasAttribute('scoreFrequency', Score::class);
        $this->assertClassHasAttribute('suits', Score::class);
        $this->assertClassHasAttribute('straight', Score::class);
    }

    /**
     * verify that the checkScore() returns correct property and value
     * , use no arguments.
     */
    public function testCheckScore()
    {
        $testArray = array(
            '0' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '1' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '2' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '3' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '4' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '5' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '6' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '7' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '8' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '9' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
        );
        $answerArray = [];
        foreach($testArray as $key =>$value)
        {
            $answerArray[$key] = 15;
        };
        $score = new Score();
        $test = $score->checkScore($testArray);
        $this->assertIsArray($test);
        $this->assertEquals($test, $answerArray);
        
    }

    /**
     * verify that the getScoreFrequency() returns correct property and value
     * , use no arguments.
     */
    public function testGetScoreFrequency()
    {
        $testArray = array(
            '0' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '1' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '2' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '3' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '4' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '5' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '6' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '7' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '8' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
            '9' => ["2♥" => 2, "3♥" => 3, "4♥" => 4, "5♥" => 5, "A♦" => 14 ],
        );
        $scoreFrequency = [
            "Royal flush" => 0,
            "Straight flush" => 0,
            "Four of a kind" => 0,
            "Full house" => 0,
            "Flush" => 0,
            "Straight" => 10,
            "Three of a kind" => 0,
            "Two pairs" => 0,
            "One pair" => 0,
            "No hand" => 0,
        ];
        $score = new Score();
        $test = $score->checkScore($testArray);
        $test = $score->getScoreFrequency();
        $this->assertIsArray($test);
        $this->assertEquals($test, $scoreFrequency);
        
    }
   
}
