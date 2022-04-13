<?php

namespace App\Controller\card;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerJson
{
    private object $deck;

    /**
     * @Route(
     * "/card/api/deck",
     * name="api-sort",
     * methods={"GET","HEAD"}
     * )
     */
    public function sortedDeck(): Response
    {
        $this->deck = new \App\Cards\Deck();
        $data = [
            'deck' => $this->deck->get()
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
    * @Route(
    * "card/api/deck/shuffle",
    * name="api-shuffle",
    * methods={"POST"}
    * )
    */
    public function shuffleDeck(): Response
    {
        $this->deck = new \App\Cards\Deck();
        $data = [
            'deck' => $this->deck->shuffleDeck()
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
