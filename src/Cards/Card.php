<?php

namespace App\Cards;

class Card
{

    protected $FULL_SET = [];
    protected $SUITS = [
        "♥",
        "♦",
        "♣",
        "♠",
    ];
    protected $RANKS = [
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

    public function getSet(): array
    {
        return $this->FULL_SET;
    }

    public function getSuits(): array
    {
        return $this->SUITS;
    }

    public function getRanks(): array
    {
        return $this->RANKS;
    }
}
