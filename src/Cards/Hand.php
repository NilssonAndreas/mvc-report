<?php

namespace App\Cards;

class Hand
{
    protected $hand;

    public function __construct()
    {
      $this->hand = [];
    }

    public function addCardToHand($cards): void
    {
        $this->hand = array_merge($this->hand, $cards);
    }

    public function showHand(): array
    {
        return $this->hand;
    }

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