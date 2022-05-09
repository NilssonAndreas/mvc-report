<?php

namespace App\Controller\game;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
        $game = new \App\Cards\Game($player, $deck);
        $data = [
            'title' => '21'
        ];
        $session->set("myGame", $game);
        return $this->render('game/home.html.twig', $data);
    }

    /**
     * @Route(
     *      "/game/doc",
     *      name="game-doc")
     */
    public function doc(): Response
    {
        $data = [
            'title' => 'doc'
        ];
        return $this->render('game/doc.html.twig', $data);
    }

    /**
     * @Route("/game/start", name="game-start")
     */
    public function start(SessionInterface $session): Response
    {
        $game = $session->get("myGame");
        $game->setGameState();
        $data = [
            'title' => 'Spela',
            'game' => $game,
        ];
        $session->set("myGame", $game);
        return $this->render('game/start.html.twig', $data);
    }

    /**
    * @Route(
    * "/game/result",
    *  name="game-result")
    */
    public function result(SessionInterface $session): Response
    {
        $game = $session->get("myGame");
        $endMessage = $game->endState();
        $data = [
            'title' => 'Resultat',
            'game' => $game,
            'end' => $endMessage
        ];
        $session->set("myGame", $game);
        return $this->render('game/result.html.twig', $data);
    }
}
