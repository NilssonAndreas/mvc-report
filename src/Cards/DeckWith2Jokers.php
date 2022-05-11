<?php

namespace App\Cards;

class DeckWith2Jokers extends Deck
{
    public function __construct()
    {
        parent::__construct();
        $this->deck["joker1"] = 15;
        $this->deck["joker2"] = 15;
    }
}
