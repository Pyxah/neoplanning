<?php

namespace App\Controller;

use App\Entity\Garde;
use App\Entity\User;
use App\Entity\Reservations;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

        $garde = $this->getDoctrine()->getRepository(Garde::class)->findBy(
            ['id' => 3]
        );
        $reservations = $this->getDoctrine()->getRepository(Reservations::class)->findBy(['garde'=>3]);
        return $this->render('technique/index.html.twig', [
            'controller_name' => 'TechniqueController',
            'users' => $users,
            'garde' => $garde,
            'reservations'=>$reservations,
            'gardeId'=>'3'
        ]);
    }

    /**
     * @Route("/sendData/tech", name="tech_send_data")
     */
    public function sendData(Request $request)
    {

        $this->forward('App\Controller\ReservationsController::processData', [
            'request'  => $request,
            'gardeID' => 3
        ]);


        return new JsonResponse(null, 200);
    }
}
