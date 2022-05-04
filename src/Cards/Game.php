<?php

namespace App\Cards;

class Game
{
    protected $player;
    protected $bank;
    protected $deck;
    protected bool $bust = false;

    public function __construct(Player $newPlayer, Deck $newDeck)
    {
        $this->player = new $newPlayer();
        $this->deck = new $newDeck();
        $this->deck->shuffleDeck();
    }

    public function getPlayer(): object
    {
        return $this->player;
    }

    public function getDeck(): object
    {
        return $this->deck;
    }

    public function getBust(): bool
    {
        return $this->bust;
    }

    public function setGameState(): void
    {
        $draw = $this->deck->draw();
        $this->player->addCards([$draw]);
        $this->setScore();
        $scoreState = $this->checkIfBust();
        echo($scoreState);
        if ($this->bust == true){
            echo("   NOW IS FALSE");
        }
    }

    private function setScore(): void
    {
        $cards = $this->player->getCards();
        $this->player->resetScore();
        foreach ($cards as $card) {
            if (intval($card[0]) > 1) {
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

    private function checkIfBust(): string
    {
        $score = $this->player->getScore();
        if ($score > 21) {
            $this->bust = true;
            return "Bust";
        }
        return "score: $score";
    }
}
