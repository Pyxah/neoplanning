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
        $reservations = $this->getDoctrine()->getRepository(Reservations::class)->findBy(['garde'=>1]);


        return $this->render('administrative/index.html.twig', [
            'controller_name' => 'AdministrativeController',
            'users' => $users,
            'garde' => $garde,
            'reservations'=>$reservations,
            'gardeId'=>'1'
        ]);
    }

    /**
     * @Route("/sendData/gadmin", name="gadmin_send_data")
     */
    public function sendData(Request $request)
    {
        $this->forward('App\Controller\ReservationsController::processData', [
            'request'  => $request,
            'gardeID' => 1
        ]);


        return new JsonResponse(null, 200);
    }
}
