<?php

namespace App\Controller;

use App\Entity\User;
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

        $users = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['gid' => 1]
        );

        return $this->render('administrative/index.html.twig', [
            'controller_name' => 'AdministrativeController',
            'users' => $users
        ]);
    }
}
