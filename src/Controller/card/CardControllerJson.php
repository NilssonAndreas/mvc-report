<?php

namespace App\Controller\card;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class LuckyControllerJson
{
    // private $deck;

    /**
     * @Route(
     * "/card/api/deck",
     * methods={"GET","HEAD"}
     * )
     */
    public function number(): Response
    {
        $deck = new \App\Cards\Deck();
        
        $data = [
            'deck' => $deck->get()
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}
