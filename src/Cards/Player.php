<?php

namespace App\Cards;

class Player
{
    protected $hand;
    protected int $score;
    protected bool $bust = false;

    public function __construct()
    {
        $this->hand = new \App\Cards\Hand();
        $this->score = 0;
    }

    public function numberOfCards(): int
    {
        return sizeof($this->hand->showHand());
    }

    /** @return array<string> */
    public function getCards(): array
    {
        return $this->hand->showHand();
    }

    public function getBust(): bool
    {
        return $this->bust;
    }

    public function setBust(bool $val): void
    {
        $this->bust = $val;
    }

    /** @param array<string> $cards */
    public function addCards($cards): void
    {
        $this->hand->addCardToHand($cards);
    }

    public function addScore(int $scoreToAdd): void
    {
        $this->score += $scoreToAdd;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function resetScore(): void
    {
        $this->score = 0;
    }
}
