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

        $myDeck = $game->getDeck();
        $draw = $myDeck->draw();
        
        $data = [
            'title' => 'Poker Square'
        ];
        $session->set("myGame", $game);
        $session->set("card", $draw);
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
    
        $roundData = $game->round($id, $slot);
        $session->set("card", $roundData['card']);

        $data = [
            'title' => 'Poker Square',
            'board' => $roundData['board'],
            'card' => $session->get("card"),
            'slots' => $roundData['slots']
        ];

        return $this->render('proj/start.html.twig', $data);
    }

    /**
    * @Route(
    * "/proj/result",
    *  name="proj-result")
    */
    public function result(SessionInterface $session): Response
    {
        $game = $session->get("myGame");
        $hands = $game->finnish();
        $board = $game->getBoard()->getBoard();
        $data = [
            'title' => 'Resultat',
            'score' => $hands,
            'board' => $board,
        ];
        return $this->render('proj/result.html.twig', $data);
    }
}
