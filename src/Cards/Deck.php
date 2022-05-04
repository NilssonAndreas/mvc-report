<?php

namespace App\Cards;

class Deck
{
    /** @var array<string> */
    protected array $deck;

    public function __construct()
    {
        $newDeck = new \App\Cards\Card();
        $this->deck = $newDeck->getSet();
    }

    /** @return array<string> */
    public function get(): array
    {
        return $this->deck;
    }

    /** @return array<string> */
    public function shuffleDeck(): array
    {
        shuffle($this->deck);
        return $this->deck;
    }

    public function draw(): ?string
    {
        $removed = array_shift($this->deck);
        return $removed;
    }

    public function countCards(): ?int
    {
        return sizeof($this->deck);
    }

    public function reset(): void
    {
        $newDeck = new \App\Cards\Card();
        $this->deck = $newDeck->getSet();
    }
}
