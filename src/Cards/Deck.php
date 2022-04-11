<?php

namespace App\Cards;

class Deck
{
    protected $deck = [];

    public function __construct()
    {
        $this->deck = new \App\Cards\Card();
        $this->deck = $this->deck->getSet();
    }

    public function get(): array
    {
        return $this->deck;
    }

    public function shuffleDeck(): array
    {
        shuffle($this->deck);
        return $this->deck;
    }

    public function reset(): array
    {
        $this->deck = new \App\Cards\Card();
        $this->deck = $this->deck->getSet();
    }
}
