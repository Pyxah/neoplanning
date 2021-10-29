<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SoinsController extends AbstractController
{
    /**
     * @Route("/soins", name="soins")
     */
    public function index(): Response
    {
        return $this->render('soins/index.html.twig', [
            'controller_name' => 'SoinsController',
        ]);
    }
}
