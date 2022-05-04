<?php

namespace App\Cards;

class Game
{

    protected $player;
    protected $bank;
    protected $deck;
    
    public function __construct( Player $newPlayer, Deck $newDeck)
    {
        $this->player = new $newPlayer;
        $this->deck = $newDeck;
    }

    public function getPlayer(): object
    {
        return $this->player;
    }

    public function getDeck(): object
    {
        return $this->deck;
        
    }

    public function setGameState(): void
    {
        $this->setScore();
        $this->checkScore();
    }

    private function setScore()
    {
        
        $cards = $this->player->getCards();
        $this->player->resetScore();
        foreach($cards as $card) {

            if( intval($card[0]) > 1) {
                $this->player->addScore(intval($card[0]));
            }

            switch ($card[0]) {
                case 'A':
                    $this->player->addScore(1);
                    break;
                case 'K':
                    $this->player->addScore(13);
                    break;
                case 'Q':
                    $this->player->addScore(12);
                    break;
                case 'J':
                    $this->player->addScore(11);
                    break;
                case 1:
                    $this->player->addScore(10);
                    break;
            }
        }
    }

    private function checkScore(): string
    {
        $score = $this->player->getScore();
        echo($score);
        if($score > 21){
            return "Bust";
        }
        return "score: $score";
    }
}