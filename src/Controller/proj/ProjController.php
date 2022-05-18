<?php

namespace App\Controller\proj;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjController extends AbstractController
{
    /**
     * @Route(
     *      "/proj/",
     *      name="proj-home")
     */
    public function home(SessionInterface $session): Response
    {
        $board = new \App\Cards\Board();
        $deck = new \App\Cards\Deck();
        $game = new \App\Cards\Square($deck, $board);
        $data = [
            'title' => 'Poker Square'
        ];
        $session->set("myGame", $game);
        return $this->render('proj/home.html.twig', $data);
    }

    /**
     * @Route(
     *      "/proj/about",
     *      name="proj-doc")
     */
    public function doc(): Response
    {
        $data = [
            'title' => 'doc'
        ];
        return $this->render('proj/about.html.twig', $data);
    }

    /**
     * @Route(
     *      "/proj/reset",
     *      name="reset")
     */
    public function reset(): Response
    {
        //SHOULD RESET ORM DATABASE
        // BARA ANVÄNDA EN TABLE KÖRA DROP TABLE?
        $data = [
            'title' => 'reset'
        ];
        return $this->render('proj/about.html.twig', $data);
    }

    /**
     * @Route("/proj/start/{id}", name="proj-start")
     */
    public function start(string $id, SessionInterface $session): Response
    {
        $game = $session->get("myGame");
        $slot = $session->get("card");
        $board = $game->getBoard();
        $board->setSlot($id, $slot);
        $boardArray = $board->getBoard();
        $deck = $game->getDeck();
        $draw = $deck->draw();
        $session->set("card", $draw);
        
        $data = [
            'title' => 'Poker Square',
            'board' => $boardArray,
        ];
        return $this->render('proj/start.html.twig', $data);
    }

    // /**
    // * @Route(
    // * "/game/result",
    // *  name="game-result")
    // */
    // public function result(SessionInterface $session): Response
    // {
    //     $game = $session->get("myGame");
    //     $endMessage = $game->endState();
    //     $data = [
    //         'title' => 'Resultat',
    //         'game' => $game,
    //         'end' => $endMessage
    //     ];
    //     $session->set("myGame", $game);
    //     return $this->render('game/result.html.twig', $data);
    // }
}
