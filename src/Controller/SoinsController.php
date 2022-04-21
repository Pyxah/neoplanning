<?php

namespace App\Controller;

use App\Entity\User;
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
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['gid' => 4]
        );

        return $this->render('soins/index.html.twig', [
            'controller_name' => 'SoinsController',
            'users' => $users
        ]);
    }
}
