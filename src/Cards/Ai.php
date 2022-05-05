<?php

namespace App\Cards;

class Ai extends Player
{
    protected bool $keepDrawing = true;

    public function __construct()
    {
        parent::__construct();
    }

    /** @param array<string> */
    public function initiateAi($card)
    {
        if ($this->keepDrawing == true) {
            $this->addCards($card);
        }
    }
}
