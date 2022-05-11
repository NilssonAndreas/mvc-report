<?php

namespace App\Controller\card;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CardController extends AbstractController
{
    /**
     * @Route(
     *      "/card/",
     *      name="card-home")
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
    public function deck(): Response
    {
        $deck = new \App\Cards\Deck();
        $data = [
            'title' => 'Current-Deck',
            'deck' => $deck->get()
        ];
        return $this->render('card/card.html.twig', $data);
    }

    /**
     * @Route("/card/deck/shuffle", name="deck-shuffle")
     */
    public function shuffle(SessionInterface $session): Response
    {
        $deck = new \App\Cards\Deck();
        $deck->shuffleDeck();
        $data = [
            'title' => 'Current-Deck',
            'deck' => $deck->get()
        ];
        $session->set("myDeck", $deck);
        return $this->render('card/card.html.twig', $data);
    }

    /**
    * @Route(
    * "/card/deck/draw",
    *  name="deck-draw")
    */
    public function draw(SessionInterface $session): Response
    {
        $deck = $session->get("myDeck") ?? new \App\Cards\Deck();
        $card = $deck->draw();
        $count = $deck->countCards();
        $data = [
            'title' => 'Your Draw',
            'draw' => $card,
            'count' => $count
        ];
        $session->set("myDeck", $deck);
        return $this->render('card/draw.html.twig', $data);
    }

    /**
     * @Route("/card/deck/draw/{numRolls}", name="deck-multiRoll")
     */
    public function multiDraw(int $numRolls, SessionInterface $session): Response
    {
        $deck = $session->get("myDeck") ?? new \App\Cards\Deck();

        $draw = [];
        for ($i = 1; $i <= $numRolls; $i++) {
            $draw[] = $deck->draw();
        }
        $count = $deck->countCards();
        $data = [
            'title' => 'This is your draw',
            'numRolls' => $numRolls,
            'draw' => $draw,
            'count' => $count
        ];
        $session->set("myDeck", $deck);
        return $this->render('card/draw.html.twig', $data);
    }

    /**
     * @Route(
     * "/card/deck/deal/{numPlayer}/{numCards}",
     *  name="deck-deal")
     * )
     */
    public function playerDeal(int $numPlayer, int $numCards): Response
    {
        $deck = new \App\Cards\Deck();
        $deck->shuffleDeck();
        $players = [];

        for ($i = 1; $i <= $numPlayer; $i++) {
            $newPlayer = new \App\Cards\Player();
            $cards = [];
            for ($x = 1; $x <= $numCards; $x++) {
                $card = $deck->draw();
                $cards[array_key_first($card)] = array_values($card)[0];
            }
            $newPlayer->addCards($cards);
            $players[] = [
                'name' => "Player: {$i}",
                'cards' => $newPlayer->getCards()
            ];
        }
        $count = $deck->countCards();
        $data = [
            'title' => 'Deal',
            'numPlayer' => $numPlayer,
            'numCards' => $numCards,
            'players' => $players,
            'count' => $count
        ];

        return $this->render('card/deal.html.twig', $data);
    }

    /**
     * @Route("/card/deck2", name="card-deck2")
     */
    public function deck2(): Response
    {
        $deck = new \App\Cards\DeckWith2Jokers();
        $data = [
            'title' => 'Joker',
            'deck' => $deck->get()
        ];
        return $this->render('card/card.html.twig', $data);
    }
}
