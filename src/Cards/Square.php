<?php

namespace App\Cards;

class Square
{
    protected $deck;
    protected int $score;
    protected $board;
    protected $card;
    protected $usedSlots;

    public function __construct(Deck $newDeck, Board $newBoard)
    {
        $this->deck = new $newDeck();
        $this->board = new $newBoard();
        $this->deck->shuffleDeck();
        $this->usedSlots = [];
    }

    /** @return Deck */
    public function getDeck(): object
    {
        return $this->deck;
    }

    /** @return Board */
    public function getBoard(): object
    {
        return $this->board;
    }

    /**
     * @return array<mixed>
     * @param int $id
     * @param array $card
     * Handels one round of play with anti cheat
     */
    public function round($id, $card): array
    {

        if ( ! in_array($id, $this->usedSlots))
        {
            $this->board->setSlot($id, $card);
            $this->card = $this->deck->draw();
            $this->usedSlots[] = $id;
           
            $data = [
                'card' => $this->card,
                'slots' => $this->board->getSlots(),
                'board' => $this->board->getBoard(),
            ];
            return $data;
        } 
        $data = [
                'card' => $this->card,
                'slots' => $this->board->getSlots(),
                'board' => $this->board->getBoard(),
        ];
        return $data;
    } 

    /**
     * @return array<mixed>
     * Calculate score based on board
     */
    public function finnish(): array
    {
        $hands = [];
        
        return $hands;
    }

}
