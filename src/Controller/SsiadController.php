<?php

namespace App\Controller;

use App\Entity\User;
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
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(
            ['gid' => 5]
        );

        return $this->render('ssiad/index.html.twig', [
            'controller_name' => 'SsiadController',
            'users' => $users
        ]);
    }
}
