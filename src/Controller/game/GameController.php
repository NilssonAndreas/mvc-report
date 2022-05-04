<?php

namespace App\Controller\game;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    /**
     * @Route(
     *      "/game/",
     *      name="game-home")
     */
    public function home(SessionInterface $session): Response
    {
        $player = new \App\Cards\Player();
        $deck = new \App\Cards\Deck();
        $game = new \App\Cards\Game( $player, $deck);
        $data = [
            'title' => 'Game'
        ];
        $session->set("myGame", $game);
        return $this->render('game/home.html.twig', $data);
    }

    /**
     * @Route("/game/start", name="game-start")
     */
    public function start(SessionInterface $session): Response
    {
        $game = $session->get("myGame");
        $game->setGameState();
        $data = [
            'title' => 'Game-Start',
            'game' => $game,
        ];
        $session->set("myGame", $game);
        return $this->render('game/start.html.twig', $data);
    }

    // /**
    //  * @Route("/card/deck/shuffle", name="deck-shuffle")
    //  */
    // public function shuffle(SessionInterface $session): Response
    // {
    //     $deck = new \App\Cards\Deck();
    //     $deck->shuffleDeck();
    //     $shuffle = $deck->get();
    //     $data = [
    //         'title' => 'Current-Deck',
    //         'deck' => $deck->get()
    //     ];
    //     $session->set("myDeck", $deck);
    //     return $this->render('card/card.html.twig', $data);
    // }

    // /**
    // * @Route(
    // * "/card/deck/draw",
    // *  name="deck-draw")
    // */
    // public function draw(SessionInterface $session): Response
    // {
    //     $deck = $session->get("myDeck") ?? new \App\Cards\Deck();
    //     $card = $deck->draw();
    //     $count = $deck->countCards();
    //     $data = [
    //         'title' => 'Your Draw',
    //         'draw' => $card,
    //         'count' => $count
    //     ];
    //     $session->set("myDeck", $deck);
    //     return $this->render('card/draw.html.twig', $data);
    // }

    // /**
    //  * @Route("/card/deck/draw/{numRolls}", name="deck-multiRoll")
    //  */
    // public function multiDraw(int $numRolls, SessionInterface $session): Response
    // {
    //     $deck = $session->get("myDeck") ?? new \App\Cards\Deck();

    //     $draw = [];
    //     for ($i = 1; $i <= $numRolls; $i++) {
    //         $draw[] = $deck->draw();
    //     }
    //     $count = $deck->countCards();
    //     $data = [
    //         'title' => 'This is your draw',
    //         'numRolls' => $numRolls,
    //         'draw' => $draw,
    //         'count' => $count
    //     ];
    //     $session->set("myDeck", $deck);
    //     return $this->render('card/draw.html.twig', $data);
    // }

    // /**
    //  * @Route(
    //  * "/card/deck/deal/{numPlayer}/{numCards}",
    //  *  name="deck-deal")
    //  * )
    //  */
    // public function playerDeal(int $numPlayer, int $numCards): Response
    // {
    //     $deck = new \App\Cards\Deck();
    //     $deck->shuffleDeck();
    //     $players = [];
    //     for ($i = 1; $i <= $numPlayer; $i++) {
    //         $newPlayer = new \App\Cards\Player();
    //         $cards = [];
    //         for ($x = 1; $x <= $numCards; $x++) {
    //             $cards[] = $deck->draw();
    //         }
    //         $newPlayer->addCards($cards);
    //         $players[] = [
    //             'name' => "Player: {$i}",
    //             'cards' => $newPlayer->getCards()
    //         ];
    //     }

    //     $count = $deck->countCards();
    //     $data = [
    //         'title' => 'Deal',
    //         'numPlayer' => $numPlayer,
    //         'numCards' => $numCards,
    //         'players' => $players,
    //         'count' => $count
    //     ];

    //     return $this->render('card/deal.html.twig', $data);
    // }

    // /**
    //  * @Route("/card/deck2", name="card-deck2")
    //  */
    // public function deck2(): Response
    // {
    //     $deck = new \App\Cards\DeckWith2Jokers();
    //     $data = [
    //         'title' => 'Joker',
    //         'deck' => $deck->get()
    //     ];
    //     return $this->render('card/card.html.twig', $data);
    // }
}
