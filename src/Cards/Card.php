<?php

namespace App\Cards;

class Card
{
    /** @var array<string> */
    protected array $FULL_SET = [];

    /** @var array<string> */
    protected array $SUITS = [
        "♥",
        "♦",
        "♣",
        "♠",
    ];

    /** @var array<string> */
    protected array $RANKS = [
            "A",
            "2",
            "3",
            "4",
            "5",
            "6",
            "7",
            "8",
            "9",
            "10",
            "J",
            "Q",
            "K",
        ];

    public function __construct()
    {
        foreach ($this->SUITS as $suit) {
            foreach ($this->RANKS as $rank) {
                $this->FULL_SET[] = "{$rank}{$suit}";
            }
        }
    }

    /** @return array<string> */
    public function getSet(): array
    {
        return $this->FULL_SET;
    }

    /** @return array<string> */
    public function getSuits(): array
    {
        return $this->SUITS;
    }

    /** @return array<string> */
    public function getRanks(): array
    {
        return $this->RANKS;
    }
}
