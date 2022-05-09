<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MyTwigController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        date_default_timezone_set("Europe/Stockholm");
        $today = date("Y/m/d");
        // $url = 'https://api.adviceslip.com/advice';
        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => $url,
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_TIMEOUT => 30,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "GET",
        //     CURLOPT_HTTPHEADER => array(
        //         "cache-control: no-cache"
        // ),
        // ));

        // $response = curl_exec($curl);
        // $err = curl_error($curl);
        // curl_close($curl);

        // $response = json_decode($response, true);

        return $this->render('home.html.twig', [
        'today' => $today,
        // 'advice' => $response['slip']['advice'],

        ]);
    }

    /**
     * @Route("about", name="about")
     */
    public function about(): Response
    {
        return $this->render('about.html.twig', [
        ]);
    }

    /**
     * @Route("/report", name="report")
     */
    public function report(): Response
    {
        return $this->render('report.html.twig', [
        ]);
    }
}
