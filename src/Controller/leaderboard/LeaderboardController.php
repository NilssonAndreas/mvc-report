<?php

namespace App\Controller\leaderboard;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Leaderboard;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LeaderboardRepository;

class LeaderboardController extends AbstractController
{
    #[Route('/leaderboard', name: 'app_leaderboard')]
    public function index(): Response
    {
        return $this->render('leaderboard/index.html.twig', [
            'controller_name' => 'LeaderboardController',
        ]);
    }

    /**
    * @Route("/leaderboard/show", name="leaderboard_show_all")
    */
    public function showAllProduct(
        LeaderboardRepository $leaderboardRepository
    ): Response {
        $leaderboard = $leaderboardRepository
            ->findAll();
    // return $this->render('leaderboard/show.html.twig');
    return $this->json($leaderboard);
    }



    /**
     * @Route(
     *      "/leaderboard/create",
     *      name="leaderboard-create",
     *      methods={"GET","HEAD"}
     * )
     */
    public function insert(): Response
    {
        return $this->render('leaderboard/create.html.twig');
    }


    /**
     * @Route(
     *      "/leaderboard/create",
     *      name="leaderboard-create-process",
     *      methods={"POST"}
     * )
     */
    public function insertLeaderboard(Request $request, ManagerRegistry $doctrine): Response
    {
        $namn = $request->request->get('namn');
        $alias  = $request->request->get('alias');
        $land  = $request->request->get('land');
        $score  = $request->request->get('score');

        $entityManager = $doctrine->getManager();

        $leaderboard = new Leaderboard();
        $leaderboard->setNamn($namn);
        $leaderboard->setAlias($alias);
        $leaderboard->setLand($land);
        $leaderboard->setScore($score);

        // tell Doctrine you want to (eventually) save the Product
        // (no queries yet)
        $entityManager->persist($leaderboard);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return $this->redirectToRoute('leaderboard_show_all');
    }


    /**
     * @Route("/leaderboard/delete/{id}", name="leaderboard_delete_by_id")
     */
    public function deleteId(
        ManagerRegistry $doctrine,
        int $id
    ): Response {
        $entityManager = $doctrine->getManager();
        $leaderboard = $entityManager->getRepository(Leaderboard::class)->find($id);

        if (!$leaderboard) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }

        $entityManager->remove($leaderboard);
        $entityManager->flush();

        return $this->redirectToRoute('leaderboard_show_all');
    }
}
