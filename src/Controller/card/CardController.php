<?php

namespace App\Controller\card;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route(
     *      "/card/",
     *      name="card-home",
     *      methods={"GET","HEAD"}
     * )
     */
    public function home(): Response
    {
        $data = [
            'title' => 'Cards'
        ];
        return $this->render('card/home.html.twig', $data);
    }

    /**
     * @Route("/card/deck", name="card-deck")
     */
    public function roll(): Response
    {
        $deck = new \App\Cards\Deck();
        $data = [
            'title' => 'Current-Deck',
            'deck' => $deck->get()
        ];
        return $this->render('card/card.html.twig', $data);
    }
}
