<?php

namespace App\Cards;

class _newPlayer
{
    protected array $hand;

    public function __construct()
    {
        $this->hand = [];
    }

    public function numberOfCards(): int
    {
        return sizeof($this->hand->showHand());
    }

    public function getCards(): array
    {
        return $this->hand;
    }

    public function addCardToHand($cards): void
    {
        $this->hand = array_merge($this->hand, $cards);
    }

    public function removeCardFromHand($card): void
    {
        if (($key = array_search($card, $this->hand)) !== false) {
            unset($this->hand[$key]);
        }
    }
}
