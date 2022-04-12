<?php

namespace App\Cards;

class Player
{
    protected object $hand;

    public function __construct()
    {
        $this->hand = new \App\Cards\Hand();
    }

    public function numberOfCards(): int
    {
        return sizeof($this->hand->showHand());
    }

    public function getCards(): array
    {
        return $this->hand->showHand();
    }

    public function addCards($cards)
    {
        $this->hand->addCardToHand($cards);
    }
}
