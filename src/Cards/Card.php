<?php

namespace App\Cards;

class Card
{
    /** @var array<string> */
    protected array $fullSett = [];

    /** @var array<string> */
    protected array $suits = [
        "♥",
        "♦",
        "♣",
        "♠",
    ];

    /** @var array<int|string, int> */
    protected array $ranks = [
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
        foreach ($this->suits as $suit) {
            foreach ($this->ranks as $key => $value) {
                $this->fullSett["{$key}{$suit}"] = $value;
            }
        }
    }

    /** @return array<string> */
    public function getSet(): array
    {
        return $this->fullSett;
    }

    /** @return array<string> */
    public function getSuits(): array
    {
        return $this->suits;
    }

    /** @return  array<int|string, int> */
    public function getRanks(): array
    {
        return $this->ranks;
    }
}
