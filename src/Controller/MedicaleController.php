<?php

namespace App\Controller;

use App\Entity\User;
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
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['gid' => 2]
        );

        return $this->render('medicale/index.html.twig', [
            'controller_name' => 'MedicaleController',
            'users' => $users
        ]);
    }
}
