<?php

namespace App\Cards;

/**
 * Suppress all rules containing "Unused" in this
 * class
 *
 * @SuppressWarnings("Unused")
 */
class Score
{
    // /** @var array<mixed> */
    // private array $hands;

    /** @var array<int,bool> */
    private array $suits;

    /** @var array<int,bool> */
    private array $straight;

    /** @var array<int,int> */
    private array $score;

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

    /** @var array<string,int> */
    protected array $scoreFrequency = [
        "Royal flush" => 0,
        "Straight flush" => 0,
        "Four of a kind" => 0,
        "Full house" => 0,
        "Flush" => 0,
        "Straight" => 0,
        "Three of a kind" => 0,
        "Two pairs" => 0,
        "One pair" => 0,
        "No hand" => 0,
    ];


    /** @var array<mixed> */
    private array $occurrence;


    public function __construct()
    {
        $this->score = [];
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
                $this->scoreFrequency["Straight"]++;
                $index += 1;
                continue;
            }

            $this->checkPairs($index);

            if (! array_key_exists($index, $this->score)) {
                $this->score[$index] = $this->scoreChart["No hand"];
                $this->scoreFrequency["No hand"]++;
            }

            $index += 1;
        }
        return $this->score;
    }

    /**
     * @return array<string,int>
     * Returns ScoreFrequency
     */
    public function getScoreFrequency(): array
    {
        return $this->scoreFrequency;
    }

    /** @param array<mixed> $hand
     * @param int $index
     * Checks if same suit
     */
    private function checkSuit($hand, int $index): void
    {
        $tempArray = [];
        foreach ($hand as $key => $dummy) {
            $suit = substr($key, -1);
            if (in_array($suit, $tempArray)) {
                break;
            }
            $tempArray[$suit] = 1;
        }
        if (count($tempArray) == 1) {
            $this->suits[$index] = true;
            return;
        }

        $this->suits[$index] = false;
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
            $this->scoreFrequency["Royal flush"]++;

            return;
        }

        //Kolla stege
        if ($straight === true) {
            $this->score[$index] = $this->scoreChart["Straight flush"];
            $this->scoreFrequency["Straight flush"]++;
            return;
        }
        //Annars Flush
        $this->score[$index] = $this->scoreChart["Flush"];
        $this->scoreFrequency["Flush"]++;
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
            $handIndex += 1;
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
    private function checkPairs(int $index): void
    {
        if (max($this->occurrence[$index]) == 4) {
            $this->score[$index] = $this->scoreChart["Four of a kind"];
            $this->scoreFrequency["Four of a kind"]++;
            return;
        }

        if (end($this->occurrence[$index]) == 3 && prev($this->occurrence[$index]) == 2) {
            $this->score[$index] = $this->scoreChart["Full house"];
            $this->scoreFrequency["Full house"]++;
            return;
        }

        if (max($this->occurrence[$index]) == 3) {
            $this->score[$index] = $this->scoreChart["Three of a kind"];
            $this->scoreFrequency["Three of a kind"]++;
            return;
        }

        if (end($this->occurrence[$index]) == 2 && prev($this->occurrence[$index]) == 2) {
            $this->score[$index] = $this->scoreChart["Two pairs"];
            $this->scoreFrequency["Two pairs"]++;
            return;
        }

        if (max($this->occurrence[$index]) == 2) {
            $this->score[$index] = $this->scoreChart["One pair"];
            $this->scoreFrequency["One pair"]++;
            return;
        }
    }
}
