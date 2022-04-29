<?php

namespace App\Controller;

use App\Entity\Garde;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GardeController extends AbstractController
{
    /**
     * @Route("/garde", name="garde")
     */
    public function index(): Response
    {
        $garde = $this->getDoctrine()->getRepository(Garde::class)->findAll();

        return $this->render('garde/index.html.twig', [
            'controller_name' => 'GardeController',
            'garde' => $garde
        ]);
    }

    /**
     * @Route ("/geditcom", name="gardeEditComment")
     * @param Request $request
     */
    public function editCommentaireGarde(Garde $garde, Request $request) {
        $gardeCommentaire = $request->request->get("commentaire");
        $garde->setCommentaire($gardeCommentaire);

    return $this->render('home/index.html.twig', [
        'controller_name' => 'HomeController',
        'garde' => $garde
    ]);
    }
}
