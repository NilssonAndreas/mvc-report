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
        $this->players[$id]->addScore();
    }
    
    public function addCardsToPlayer(int $id, int $numberOfCards): void
    {
        $cardArray = [];
        foreach ( range(1, $numberOfCards) as $index) {
            $cardArray[$index] = $this->deck->draw();
        }
        $this->players[$id]->addCards($cardArray);
    }

    public function getScoreForPlayer(int $id): int
    {
        return $this->players[$id]->getScore();
    }

    public function getSpecificPlayer(int $id): object
    {
        return $this->players[$id];
    }

    public function getDeck(): object
    {
        return $this->deck;
        
    }

    public function setGameState(): void
    {
        foreach ($this->players as $key=>$value){
            $cards = $value->getCards();
            $value->resetScore();
            foreach($cards as $card) {

                if( intval($card[0]) > 1) {
                    $value->addScore(intval($card[0]));
                }

                switch ($card[0]) {
                    case 'A':
                        $value->addScore(1);
                        break;
                    case 'K':
                        $value->addScore(13);
                        break;
                    case 'Q':
                        $value->addScore(12);
                        break;
                    case 'J':
                        $value->addScore(11);
                        break;
                    case 1:
                        $value->addScore(10);
                        break;
                }
            }
            echo($value->getScore());
        };



    }
}