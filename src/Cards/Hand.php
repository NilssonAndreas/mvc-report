<?php

namespace App\Cards;

class Hand
{
    /** @var array<mixed> */
    protected array $hand;

    public function __construct()
    {
        $this->hand = [];
    }

    /** @param array<string> $cards */
    public function addCardToHand($cards): void
    {
        $this->hand = array_merge($this->hand, $cards);
    }

    /** @return array<mixed> */
    public function showHand()
    {
        return $this->hand;
    }

    /** @param string $card */
    public function removeCardFromHand($card): void
    {
        if (($key = array_search($card, $this->hand)) !== false) {
            unset($this->hand[$key]);
        }
    }

    public function clearHand(): void
    {
        $this->hand = [];
    }
}
