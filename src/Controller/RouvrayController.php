<?php

namespace App\Controller;

use App\Entity\User;
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
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['gid' => 6]
        );

        return $this->render('rouvray/index.html.twig', [
            'controller_name' => 'RouvrayController',
            'users' => $users
        ]);
    }
}
