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

        $garde = $this->getDoctrine()->getRepository(Garde::class)->findBy(
            ['id' => 5]
        );
        $reservations = $this->getDoctrine()->getRepository(Reservations::class)->findBy(['garde'=>5]);
        return $this->render('ssiad/index.html.twig', [
            'controller_name' => 'SsiadController',
            'users' => $users,
            'garde' => $garde,
            'reservations'=>$reservations,
            'gardeId'=>'5'
        ]);
    }

    /**
     * @Route("/sendData/ssiad", name="ssiad_send_data")
     */
    public function sendData(Request $request)
    {

        $this->forward('App\Controller\ReservationsController::processData', [
            'request'  => $request,
            'gardeID' => 5
        ]);


        return new JsonResponse(null, 200);
    }
}
