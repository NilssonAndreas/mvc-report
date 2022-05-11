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

    /** @return Player */
    public function getPlayer(): object
    {
        return $this->player;
    }

    /** @return Deck */
    public function getDeck(): object
    {
        return $this->deck;
    }

    /**
     * Handles one round of 21.
     * draws then gives card to player.
     * Sets score and checks if bust
     */
    public function setGameState(): void
    {
        $draw = $this->deck->draw();
        $this->player->addCards($draw);
        $this->setScore($this->player);
        $this->checkIfBust($this->player);
    }

    /**
     * Handles end of game.
     */
    public function endState(): string
    {
        $this->drawAi();
        $endMessage = $this->checkWinner();
        return $endMessage;
    }

    /** @param Player $entity
     * Sets score for $entity
    */
    private function setScore($entity): void
    {
        $entity->setScore();
    }

    /** @param Player $entity
    */
    private function checkIfBust($entity)
    {
        $score = $entity->getScore();
        if ($score > 21) {
            $entity->setBust(true);
        }
    }

    /**
     * Ai for 21
     */
    private function drawAi(): void
    {
        while ($this->bank->getScore() < 17) {
            $draw = $this->deck->draw();
            $this->bank->addCards($draw);
            $this->setScore($this->bank);
            $this->checkIfBust($this->bank);
        }
    }


    /**
    * @return string winner of $PlayerScore and $BankScore
    */
    private function checkWinner(): string
    {
        $playerScore = $this->player->getScore();
        $bankScore = $this->bank->getScore();

        if ($bankScore >= $playerScore && $this->bank->getBust() == false) {
            return "Banken vinner med: $bankScore vs $playerScore";
        }
        return "Du vinner med: $playerScore vs $bankScore";
    }
}
