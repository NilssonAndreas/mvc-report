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

    /**
     * Shuffles deck.
     */
    public function shuffleDeck(): void
    {
        $keys = array_keys($this->deck);
        $new = [];
        shuffle($keys);

        foreach ($keys as $key) {
            $new[$key] = $this->deck[$key];
        }
        $this->deck = $new;
    }

    public function draw(): ?array
    {
        $result = array_splice($this->deck, 0, 1);
        return $result;
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

    /**
     * Changes value of A to 14
     */
    public function aceMax(): void
    {
        $this->deck['A♦'] = 14;
        $this->deck['A♥'] = 14;
        $this->deck['A♣'] = 14;
        $this->deck['A♠'] = 14;
    }

}
