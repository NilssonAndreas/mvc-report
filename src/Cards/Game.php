<?php

namespace App\Cards;

class Game
{

    protected $players = [];
    protected $deck;
    
    public function __construct( Player $player, int $numberOfPlayers, Deck $newDeck)
    {
        foreach (range(1, $numberOfPlayers) as $number) {
            $this->players[$number] = new $player;
        }
        $this->deck = $newDeck;
    }

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function addScoreToPlayer(int $id, int $score): void
    {
        $this->players[$id]->addScore($score);
        
    }
    
    public function getScoreForPlayer(int $id): int
    {
        return $this->players[$id]->getScore();
    }

    public function getSpecificPlayer(int $id): object
    {
        return $this->players[$id];
    }

    public function getDeck()
    {
        return $this->deck;
        
    }
}