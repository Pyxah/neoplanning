<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TechniqueController extends AbstractController
{
    /**
     * @Route("/tech", name="technique")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['gid' => 3]
        );

        return $this->render('technique/index.html.twig', [
            'controller_name' => 'TechniqueController',
            'users' => $users
        ]);
    }
}
