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
        $this->player->addCards([$draw]);
        $this->setScore($this->player);
        $scoreState = $this->checkIfBust($this->player);
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

    /** @param Player $entity
     *  @return string $score for $entity
    */
    private function checkIfBust($entity): string
    {
        $score = $entity->getScore();
        if ($score > 21) {
            $entity->setBust(true);
            return "Bust: $score";
        }
        return "score: $score";
    }

    /**
     * Ai for 21
     */
    private function drawAi(): void
    {
        while ($this->bank->getScore() < 17) {
            $draw = $this->deck->draw();
            $this->bank->addCards([$draw]);
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
