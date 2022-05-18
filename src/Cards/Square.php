<?php

namespace App\Cards;

class Square
{
    protected $deck;
    protected int $score;
    protected $board;

    public function __construct(Deck $newDeck, Board $newBoard)
    {
        $this->deck = new $newDeck();
        $this->board = new $newBoard();
        $this->deck->shuffleDeck();
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


    /**
     * Ends game and calculate score
     */
    public function finnish(): int
    {
        
        return $this->score;
    }

}
