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

    public function draw(): string
    {
        $removed = array_shift($this->deck);
        return $removed;
    }

    public function countCards(): int
    {
        return sizeof($this->deck);
    }

    public function reset(): void
    {
        $this->deck = new \App\Cards\Card();
        $this->deck = $this->deck->getSet();
    }
}
