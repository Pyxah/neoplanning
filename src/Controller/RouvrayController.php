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

        $garde = $this->getDoctrine()->getRepository(Garde::class)->findBy(
            ['id' => 6]
        );
        $reservations = $this->getDoctrine()->getRepository(Reservations::class)->findBy(['garde'=>6]);
        return $this->render('rouvray/index.html.twig', [
            'controller_name' => 'RouvrayController',
            'users' => $users,
            'garde' => $garde,
            'reservations'=>$reservations,
            'gardeId'=>'6'
        ]);
    }

    /**
     * @Route("/sendData/rouvray", name="rouvray_send_data")
     */
    public function sendData(Request $request)
    {

        $this->forward('App\Controller\ReservationsController::processData', [
            'request'  => $request,
            'gardeID' => 6
        ]);


        return new JsonResponse(null, 200);
    }
}
