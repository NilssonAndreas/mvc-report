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

    /** @var array<mixed> */
    protected array $scoreChart = [
        "Royal flush" => 100,
        "Straight flush" => 75,
        "Four of a kind" => 50,
        "Full house" => 25,
        "Flush" => 20,
        "Straight" => 15,
        "Three of a kind" => 10,
        "Two pairs" => 5,
        "One pair" => 2,
    ];

    /** @var array<mixed> */
    protected array $occurrence;


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
        
        foreach($handsToCheck as $hand)
        {
            $this->checkSuit($hand, $index);
            $this->checkStraight($hand, $index);
            // Kolla om Färg
            if ($this->suits[$index] == true)
            {
                $straightBool = $this->straight[$index];
                $handScore = $this->whenFlush($hand, $straightBool);
                $this->score[$index] = $handScore;
                $index += 1;
                continue;
            }


            // KOlla 4 i rad


            //Kolla FullHouse

            
            // Kolla om Stege
            if ($this->straight[$index] == true)
            {
                $this->score[$index] = $this->scoreChart["Straight"];
                $index += 1;
                continue;
            }

            //3


            //2


            //1

            // TEMP
            $handScore = 10;
            $this->score[$index] = $handScore;
            $index += 1;
            
        }

        error_log(print_r($this->score, true));
        return $this->score;
    }


    /** @param array<array> $handsToCheck
     * @param int $index
     * Checks if same suit
     */
    private function checkSuit($hand, int $index)
    {
        // FYLL MED ID OCH BOOL
        
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
            } else {
                $this->suits[$index] = false;
            }
        
    }

    /** @param array<mixed> $hand
     * @param bool $straight)
     * Checks score when all suits is the same
     */
    private function whenFlush($hand, bool $straight): int
    {   
        $valueTotal = array_sum($hand);
        
        //Kolla om Royal flush 
        if( $valueTotal == 60) {
            return $this->scoreChart["Royal flush"];
        }

        //Kolla stege
        if ( $straight == true)
        {
            return $this->scoreChart["Straight flush"];
        }
        //Annars Flush
        return $this->scoreChart["Flush"];
    }

    /** @param array<array> $handsToCheck
     * @param int $index
     * Checks if straight
     */
    private function checkStraight($hand, $index): void
    {
        
            //Skapa array av värden
            $handIndex = 0;
            $tempArray = [];
            foreach($hand as $value)
            {
                $tempArray[$handIndex] = $value;
                $handIndex +=1;
            }

            // Kolla om 5 olika
            $tempArray = array_unique($tempArray);
            if( count($tempArray) != 5)
            {
                $this->straight[$index] = false;
                return;
            }

            // kolla om i rad
            $maxValue = max($tempArray);
            $minValue = min($tempArray);

            if($maxValue - $minValue == 4)
            {
                $this->straight[$index] = true;
                return;
            }
            
            // Kolla om stege (A - 5)
            if($maxValue == 14 && array_sum($tempArray) == 28)
            {
                $this->straight[$index] = true;
                return;
            }

            // Ingen stege Hittad
            $this->straight[$index] = false;
        
    }

    /** @param array<array> $handsToCheck
    * @param int $index
    * Check occurrence
    */
    private function findOccurrence($hand, $index)
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

