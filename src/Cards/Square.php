<?php

namespace App\Cards;

class Square
{
    protected $deck;
    protected $score;

    public function __construct(Deck $newDeck)
    {
        $this->deck = new $newDeck();
        $this->deck->shuffleDeck();
    }

    /** @return Deck */
    public function getDeck(): object
    {
        return $this->deck;
    }

    public function finnish(): int
    {
        $result = 0;
        return $result;
    }

}
