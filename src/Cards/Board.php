<?php

namespace App\Cards;

class Board
{
    /** @var array<string> */
    protected array $board = [];

    public function __construct()
    {
        for ($i = 1 ; $i < 26; $i++)
        {
             $this->board[$i] = " ";
        }
    }

    /** @return array<string> 
     * Used to get whole board
    */
    public function getBoard(): array
    {
        return $this->board;
    }

     /** @param string $card
     * @param int $number
     * fills slot with card $card
    */
    public function setSlot($number, $card): void
    {
        if ($number != 0){
            $this->board[$number] = $card;
        }
        
    }

}
