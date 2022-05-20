<?php

namespace App\Cards;

class Score
{
    /** @var array<mixed> */
    protected array $hands;

    /** @var array<int,bool> */
    protected array $suits;

    /** @var array<int,bool> */
    protected array $straight;

    /** @var array<int,int> */
    protected array $score;

    /** @var array<string,int> */
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
        "No hand" => 0,
    ];

    /** @var array<mixed> */
    protected array $occurrence;


    public function __construct()
    {
        $this->hands = [];
    }

    /** @param array<mixed> $handsToCheck
     *  @return array<mixed>
     * checks score of hands
     */
    public function checkScore($handsToCheck): array
    {
        $index = 0;

        foreach ($handsToCheck as $hand) {
            $this->checkSuit($hand, $index);
            $this->checkStraight($hand, $index);
            $this->findOccurrence($hand, $index);
            // Kolla om Färg
            if ($this->suits[$index] == true) {
                $straightBool = $this->straight[$index];
                $this->whenFlush($hand, $straightBool, $index);
                $index += 1;
                continue;
            }

            // Kolla om Stege
            if ($this->straight[$index] == true) {
                $this->score[$index] = $this->scoreChart["Straight"];
                $index += 1;
                continue;
            }

            $this->CheckPairs($index);

            if ($this->score[$index] == false) {
                $this->score[$index] = $this->scoreChart["No hand"];
            }

            $index += 1;
        }

        error_log(print_r($this->score, true));
        // error_log(print_r($this->occurrence, true));
        return $this->score;
    }

    /** @param array<mixed> $hand
     * @param int $index
     * Checks if same suit
     */
    private function checkSuit($hand, int $index): void
    {
        $tempArray = [];
        foreach ($hand as $key => $value) {
            $suit = substr($key, -1);
            if (in_array($suit, $tempArray)) {
                break;
            }
            $tempArray[$suit] = 1;
        }
        if (count($tempArray) == 1) {
            $this->suits[$index] = true;
        } else {
            $this->suits[$index] = false;
        }
    }

    /** @param array<mixed> $hand
     * @param bool $straight
     * @param int $index
     * Checks score when all suits is the same
     */
    private function whenFlush($hand, bool $straight, int $index): void
    {
        $valueTotal = array_sum($hand);

        //Kolla om Royal flush
        if ($valueTotal == 60) {
            $this->score[$index] = $this->scoreChart["Royal flush"];
            return;
        }

        //Kolla stege
        if ($straight == true) {
            $this->score[$index] = $this->scoreChart["Straight flush"];
            return;
        }
        //Annars Flush
        $this->score[$index] = $this->scoreChart["Flush"];
        return;
    }

    /** @param array<mixed> $hand
     * @param int $index
     * Checks if straight
     */
    private function checkStraight($hand, $index): void
    {

            //Skapa array av värden
        $handIndex = 0;
        $tempArray = [];
        foreach ($hand as $value) {
            $tempArray[$handIndex] = $value;
            $handIndex +=1;
        }

        // Kolla om 5 olika
        $tempArray = array_unique($tempArray);
        if (count($tempArray) != 5) {
            $this->straight[$index] = false;
            return;
        }

        // kolla om i rad
        $maxValue = max($tempArray);
        $minValue = min($tempArray);
        if ($maxValue - $minValue == 4) {
            $this->straight[$index] = true;
            return;
        }

        // Kolla om stege (A - 5)
        if ($maxValue == 14 && array_sum($tempArray) == 28) {
            $this->straight[$index] = true;
            return;
        }

        // Ingen stege Hittad
        $this->straight[$index] = false;
    }

    /** @param array<mixed> $hand
    * @param int $index
    * Check occurrence
    */
    private function findOccurrence($hand, $index): void
    {
        $handIndex = 0;
        $tempArray = [];
        foreach ($hand as $card) {
            $tempArray[$handIndex] = $card;
            $handIndex += 1;
        }
        $tempArray = array_count_values($tempArray);
        sort($tempArray);
        $this->occurrence[$index] = $tempArray;
    }

    /** @param int $index
    * Check paris and score points
    */
    private function CheckPairs(int $index): void
    {
        if (max($this->occurrence[$index]) == 4) {
            $this->score[$index] = $this->scoreChart["Four of a kind"];
            return;
        }

        if (end($this->occurrence[$index]) == 3 && prev($this->occurrence[$index]) == 2) {
            $this->score[$index] = $this->scoreChart["Full house"];
            return;
        }

        if (max($this->occurrence[$index]) == 3) {
            $this->score[$index] = $this->scoreChart["Three of a kind"];
            return;
        }

        if (end($this->occurrence[$index]) == 2 && prev($this->occurrence[$index]) == 2) {
            $this->score[$index] = $this->scoreChart["Two pairs"];
            return;
        }

        if (max($this->occurrence[$index]) == 2) {
            $this->score[$index] = $this->scoreChart["One pair"];
            return;
        }
    }
}
