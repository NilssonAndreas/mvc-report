<?php

namespace App\Controller\proj;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Proj;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ProjRepository;

/**
 * Suppress all rules containing "Missing" in this
 * class
 *
 * @SuppressWarnings("Missing")
 * @SuppressWarnings("Short")
 */
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
        $score = new \App\Cards\Score();
        $game = new \App\Cards\Square($deck, $board, $score);

        $myDeck = $game->getDeck();
        $draw = $myDeck->draw();

        $data = [
            'title' => 'Poker Square'
        ];
        $session->set("myGame", $game);
        $session->set("card", $draw);
        $session->set("done", false);
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
     *      name="reset",
     *      methods={"GET","HEAD"},
     * )
     */
    public function reset(): Response
    {
        $data = [
            'title' => 'reset'
        ];
        return $this->render('proj/reset.html.twig', $data);
    }


    /**
       * @Route(
       *      "/proj/reset",
       *      name="proj-reset-process",
       *      methods={"POST"},
       * )
       */
    public function resetPost(ManagerRegistry $doctrine): Response
    {
        //SHOULD RESET ORM DATABASE
        // BARA ANVÄNDA EN TABLE KÖRA DROP TABLE?
        $entityManager = $doctrine->getManager();
        $leaderboard = $entityManager->getRepository(Proj::class)->findAll();

        if (!$leaderboard) {
            throw $this->createNotFoundException(
                'No enties found '
            );
        }

        foreach ($leaderboard as $item) {
            $entityManager->remove($item);
        }

        $entityManager->flush();
        return $this->redirectToRoute('leaderboard_show_all');
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
      *      "/proj/result",
      *      name="proj-result",
      *      methods={"GET","HEAD"}
      * )
      */
    public function result(SessionInterface $session): Response
    {
        $done = $session->get("done");
        $game = $session->get("myGame");
        if ($done == false) {
            $hands = $game->finnish();
            $session->set("done", true);
            $session->set("hands", $hands);
        }
        $hand = $session->get("hands");
        $board = $game->getBoard()->getBoard();
        $score =  $game->getTotalScore();
        $data = [
            'title' => 'Resultat',
            'hands' => $hand,
            'board' => $board,
            'result' => $score
        ];
        return $this->render('proj/result.html.twig', $data);
    }

    /**
       * @Route(
       *      "/proj/result",
       *      name="proj-result-process",
       *      methods={"POST"}
       * )
       */
    public function insertResult(Request $request, ManagerRegistry $doctrine, SessionInterface $session): Response
    {
        $game = $session->get("myGame");
        $score =  $game->getTotalScore();
        $namn = $request->request->get('namn');
        $alias  = $request->request->get('alias');
        $entityManager = $doctrine->getManager();

        $proj = new Proj();

        $proj->setNamn($namn);
        $proj->setAlias($alias);
        $proj->setScore($score);

        $entityManager->persist($proj);
        $entityManager->flush();
        return $this->redirectToRoute('leaderboard_show_all');
    }

    /**
    * @Route("/proj/show", name="leaderboard_show_all")
    */
    public function showLeaderboard(
        ProjRepository $projRepository
    ): Response {
        $leaderboard = $projRepository
            ->findBy(array(), array('score' => 'DESC'));
        ;

        $data = [
            'title' => 'Leaderboard',
            'leaderboard' => $leaderboard
        ];
        return $this->render('proj/show.html.twig', $data);
    }
}
