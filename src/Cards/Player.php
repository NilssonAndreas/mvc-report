<?php

namespace App\Cards;

class Player
{
    protected object $hand;
    protected int $score;

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

    public function addCards($cards): void
    {
        $this->hand->addCardToHand($cards);
    }

    public function addScore($scoreToAdd): void
    {
        $this->$score = $this->$score + $scoreToAdd;
    }

    public function getScore(): int
    {
        return $this->$score;
    }

    public function resetScore(): void
    {
        $this->$score = 0;
    }
}
