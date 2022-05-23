<?php

namespace App\Cards;

/**
 * Suppress all rules containing "Unused or short" in this
 * class
 *
 * @SuppressWarnings("Unused")
 * @SuppressWarnings("Short")
 */
class Square
{
    protected object $deck;
    protected object $score;
    protected object $board;
    protected $card;
    protected $usedSlots;
    protected int $totalScore = 0;

    public function __construct(Deck $newDeck, Board $newBoard, Score $newScore)
    {
        $this->deck = new $newDeck();
        $this->board = new $newBoard();
        $this->score = new $newScore();
        $this->deck->aceMax();
        $this->deck->shuffleDeck();
        $this->usedSlots = [];
    }

    /** @return Deck */
    public function getDeck(): object
    {
        return $this->deck;
    }

    /** @return Board */
    public function getBoard(): object
    {
        return $this->board;
    }

    /** @return int */
    public function getTotalScore(): int
    {
        return $this->totalScore;
    }

    /**
     * @return array<mixed>
     * @param int $id
     * @param array $card
     * Handels one round of play with anti cheat
     */
    public function round($id, $card): array
    {
        if (! in_array($id, $this->usedSlots)) {
            $this->board->setSlot($id, $card);
            $this->card = $this->deck->draw();
            $this->usedSlots[] = $id;

            $data = [
                'card' => $this->card,
                'slots' => $this->board->getSlots(),
                'board' => $this->board->getBoard(),
            ];
            return $data;
        }
        $data = [
                'card' => $this->card,
                'slots' => $this->board->getSlots(),
                'board' => $this->board->getBoard(),
        ];
        return $data;
    }

    /**
     * @return array<mixed>
     * Calculate score based on board
     */
    public function finnish(): array
    {
        $hands = $this->getHands();
        $flatHands = $this->flattenHand($hands);
        $this->totalScore = array_sum($this->score->checkScore($flatHands));
        $scoreFrequency = $this->score->getScoreFrequency();
        return $scoreFrequency;
    }

    /**
     * @return array<mixed>
     * return hands from board
     */
    private function getHands(): array
    {
        $cardsOnBoard = $this->board->getBoard();
        $handIndex = 0;
        $rowIndex = 0;
        $hands = [];

        //Hands based on rows
        foreach ($cardsOnBoard as $card) {
            if ($handIndex == 5) {
                $rowIndex += 1;
                $handIndex = 0;
            }
            $hands[$rowIndex][$handIndex] = $card;
            $handIndex += 1;
        };

        //hands based on columns
        $handIndex = 0;
        $rowIndex = 5;
        foreach ($cardsOnBoard as $card) {
            if ($rowIndex == 10) {
                $rowIndex = 5;
                $handIndex += 1;
            }
            $hands[$rowIndex][$handIndex] = $card;
            $rowIndex += 1;
        };

        return $hands;
    }

    /**
     * @return array<array>
     * flattens array
     */
    private function flattenHand($hand): array
    {
        $index = 0;
        $newHand = [];

        foreach ($hand as $dummy) {
            $flat = array_merge(...$hand[$index]);
            $newHand[$index] = $flat;
            $index += 1;
        }
        return $newHand;
    }
}
