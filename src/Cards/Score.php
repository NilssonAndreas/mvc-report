<?php

namespace App\Cards;

class Score
{
    /** @var array<mixed> */
    protected array $hands;

    /** @var array<mixed> */
    protected array $suits;

    /** @var array<mixed> */
    protected array $straight;

    /** @var array<mixed> */
    protected array $score;


    public function __construct()
    {
        $this->hands = [];
    }

    /** @param array<array> $handsToCheck
     * checks score of hands
     */
    public function checkScore($handsToCheck): array
    {
        $index = 0;
        $this->checkSuit($handsToCheck);
        foreach($handsToCheck as $hand)
        {
            // KOLLA OM STEGE SEDAN BESTÄM TRUE ELLER FALSE
            $handScore = $this->whenFlush($hand, false);

            $this->score[$index] = $handScore;
            $index += 1;
            error_log(print_r($handScore, true));
        }
        error_log(print_r($this->score, true));
        return $this->score;
    }


    /** @param array<array> $handsToCheck
     * Checks if same suit
     */
    private function checkSuit($handsToCheck)
    {
        // FYLL MED ID OCH BOOL
        $index = 0;
        foreach($handsToCheck as $hand)
        {
            $tempArray = [];
            foreach($hand as $key => $value)
            {
                $suit = substr($key, -1);
                if ( in_array($suit, $tempArray))
                {
                    break;
                } 
                $tempArray[$suit] = 1;
            }
            if(count($tempArray) == 1)
            {
                $this->suits[$index] = true;
                $index += 1;
            } else {
                $this->suits[$index] = false;
                $index += 1;
            }
        }
    }

    /** @param array<mixed> $hand
     * Checks score when all suits is the same
     */
    private function whenFlush($hand, bool $straight): int
    {   
        $valueTotal = 0;
        
        foreach($hand as $card)
        {
            $valueTotal += $card;
        }

        //Kolla om Royal flush 
        if( $valueTotal == 60) {
            return 100;
        }

        //Kolla stege
        if ( $straight == true)
        {
            return 75;
        }
        //Annars Flush
        return 20;
    }

    /** @param array<array> $handsToCheck
     * Checks if straight
     */
    private function checkStraight()
    {
        
    }
}


//GET ARRAY WITH ARRAY OF HANDS.

// CHECK ALL SUITS

//IF SUITS VALUE 5
    // ROYAL
    // STRAIGHT FLUSH
    // RETURN: FLUSH


// Four of a Kind - Loop append in array as key, increase value. Check if 4 in array.

// Full House - Loop append in array as key, increase value. Check if 4 in array.

//Straight

//three of a Kind - Loop append in array as key, increase value. Check if 3 in array.

//Two Pair - Loop append in array as key, increase value. Check if 2-twice in array.

//One Pair - Loop append in array as key, increase value. Check if 2 in array.

