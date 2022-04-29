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

        $garde = $this->getDoctrine()->getRepository(Garde::class)->findBy(
            ['id' => 4]
        );
        $reservations = $this->getDoctrine()->getRepository(Reservations::class)->findBy(['garde'=>4]);
        return $this->render('soins/index.html.twig', [
            'controller_name' => 'SoinsController',
            'users' => $users,
            'garde' => $garde,
            'reservations'=>$reservations,
            'gardeId'=>'4'
        ]);
    }

    /**
     * @Route("/sendData/soins", name="soins_send_data")
     */
    public function sendData(Request $request)
    {

        $this->forward('App\Controller\ReservationsController::processData', [
            'request'  => $request,
            'gardeID' => 4
        ]);


        return new JsonResponse(null, 200);
    }
}
