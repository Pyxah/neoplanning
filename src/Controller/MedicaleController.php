<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MedicaleController extends AbstractController
{
    /**
     * @Route("/med", name="medicale")
     */
    public function index(): Response
    {
        return $this->render('medicale/index.html.twig', [
            'controller_name' => 'MedicaleController',
        ]);
    }
}
