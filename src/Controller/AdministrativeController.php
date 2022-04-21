<?php

namespace App\Controller;

use App\Entity\Garde;
use App\Entity\User;
use http\Client\Request;
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

        $garde = $this->getDoctrine()->getRepository(Garde::class)->findBy(
            ['id' => 1]
        );

        return $this->render('administrative/index.html.twig', [
            'controller_name' => 'AdministrativeController',
            'users' => $users,
            'garde' => $garde
        ]);
    }
/*
    /**
     * @Route "/gedit", name "gardeEdit")
     * @
     */
    public function editGardeCommentaire(Garde $garde, Request $request){

    }
}
