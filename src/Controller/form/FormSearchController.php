<?php

namespace App\Controller\form;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * This will suppress all the PMD warnings in
 * this class.
 *
 * @SuppressWarnings(PHPMD)
 */
class FormSearchController extends AbstractController
{
    /**
     * @Route("/form/search", name="form-search")
     */
    public function search(Request $request): Response
    {
        $data = [
            'search' => $request->query->get('search'),
        ];

        return $this->render('form/search.html.twig', $data);
    }
}
