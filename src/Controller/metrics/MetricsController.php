<?php

namespace App\Controller\metrics;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MetricsController extends AbstractController
{
    /**
     * @Route(
     *      "/metrics/",
     *      name="metrics-home")
     */
    public function home(): Response
    {
        $data = [
            'title' => 'Metrics'
        ];
        return $this->render('metrics/home.html.twig', $data);
    }
}
