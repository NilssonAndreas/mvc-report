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

    /** @var array<int|string, int> */
    protected array $RANKS = [
            "A" => 1,
            "2" => 2,
            "3" => 3,
            "4" => 4,
            "5" => 5,
            "6" => 6,
            "7" => 7,
            "8" => 8,
            "9" => 9,
            "10" => 10,
            "J" => 11,
            "Q" => 12,
            "K" => 13,
        ];

    public function __construct()
    {
        foreach ($this->SUITS as $suit) {
            foreach ($this->RANKS as $key => $value) {
                $this->FULL_SET["{$key}{$suit}"] = $value;
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

    /** @return  array<int|string, int> */
    public function getRanks(): array
    {
        return $this->RANKS;
    }
}
