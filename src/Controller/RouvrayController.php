<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RouvrayController extends AbstractController
{
    /**
     * @Route("/rouvray", name="rouvray")
     */
    public function index(): Response
    {
        return $this->render('rouvray/index.html.twig', [
            'controller_name' => 'RouvrayController',
        ]);
    }
}
