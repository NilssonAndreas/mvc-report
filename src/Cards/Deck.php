<?php

namespace App\Cards;

class Deck
{
    protected $deck = [];

    public function __construct()
    {
        $this->deck = new \App\Cards\Card();
    }

    public function get(): array
    {
        return $this->deck->getSet();
    }
}
