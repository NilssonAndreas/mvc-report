<?php

namespace App\Cards;

class Game
{
    protected $player;
    protected $bank;
    protected $deck;

    public function __construct(Player $newPlayer, Deck $newDeck)
    {
        $this->player = new $newPlayer();
        $this->bank = new $newPlayer();
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

    public function setGameState(): void
    {
        $draw = $this->deck->draw();
        $this->player->addCards([$draw]);
        $this->setScore($this->player);
        $scoreState = $this->checkIfBust($this->player);
        echo($scoreState);
        if ($this->player->getBust() == true) {
            echo("   NOW IS FALSE");
        }
    }

    public function endState()
    {
        $this->drawAi();

    }

    /** @param Player $entity */
    private function setScore($entity): void
    {
        $cards = $entity->getCards();
        $entity->resetScore();
        foreach ($cards as $card) {
            if (intval($card[0]) > 1) {
                $entity->addScore(intval($card[0]));
            }

            switch ($card[0]) {
                case 'A':
                    $entity->addScore(1);
                    break;
                case 'K':
                    $entity->addScore(13);
                    break;
                case 'Q':
                    $entity->addScore(12);
                    break;
                case 'J':
                    $entity->addScore(11);
                    break;
                case 1:
                    $entity->addScore(10);
                    break;
            }
        }
    }

    /** @param Player $entity */
    private function checkIfBust($entity): string
    {
        $score = $entity->getScore();
        if ($score > 21) {
            $entity->setBust(true);
            return "Bust";
        }
        return "score: $score";
    }

    private function drawAi(): void
    {
        while ($this->bank->getScore() < 17) {
            $draw = $this->deck->draw();
            $this->bank->addCards([$draw]);
            $this->setScore($this->bank);
            $this->checkIfBust($this->bank);
        }
        echo($this->bank->getScore());
        echo("     ---------      ");
        echo($this->bank->getBust());
    }
    
}
