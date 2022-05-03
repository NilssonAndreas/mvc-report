<?php

namespace App\Cards;

class Game
{

    protected $players = [];
    protected $deck;
    
    public function __construct( Player $player, int $numberOfPlayers, Deck $newDeck)
    {
        foreach (range(1, $numberOfPlayers) as $number) {
            $this->players[$number] = $player;
        }
        $this->deck = $newDeck;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function addScoreToPlayer(int $id, int $score)
    {
        $this->players[$id]->addScore($score);
    }
}