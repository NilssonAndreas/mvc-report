<?php

namespace App\Game;

class Game
{
    protected $FULL_SET = [];
    protected $players = [];
    
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