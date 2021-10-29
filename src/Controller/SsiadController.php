<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SsiadController extends AbstractController
{
    /**
     * @Route("/ssiad", name="ssiad")
     */
    public function index(): Response
    {
        return $this->render('ssiad/index.html.twig', [
            'controller_name' => 'SsiadController',
        ]);
    }
}
