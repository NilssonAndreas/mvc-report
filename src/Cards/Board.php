<?php

namespace App\Cards;

class Board
{
    /** @var array<string> */
    protected array $board = [];
    protected int $slotsLeft = 0;

    public function __construct()
    {
        for ($i = 1 ; $i < 26; $i++) {
            $this->board[$i] = " ";
            $this->slotsLeft += 1;
        }
    }

    /** @return array<string>
     * Used to get whole board
    */
    public function getBoard(): array
    {
        return $this->board;
    }

    /** @return int
     * Used to get available slots
    */
    public function getSlots(): int
    {
        return $this->slotsLeft;
    }


    /** @param string $card
    * @param int $number
    * fills slot with card $card
    */
    public function setSlot($number, $card): void
    {
        if ($number != 0) {
            if ($this->board[$number] == " ") {
                $this->board[$number] = $card;
                $this->slotsLeft -= 1;
            }
        }
    }
}
