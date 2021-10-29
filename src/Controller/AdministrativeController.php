<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrativeController extends AbstractController
{
    /**
     * @Route("/gadmin", name="administrative")
     */
    public function index(): Response
    {
        return $this->render('administrative/index.html.twig', [
            'controller_name' => 'AdministrativeController',
        ]);
    }
}
