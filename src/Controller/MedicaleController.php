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

        $garde = $this->getDoctrine()->getRepository(Garde::class)->findBy(
            ['id' => 2]
        );
        $reservations = $this->getDoctrine()->getRepository(Reservations::class)->findBy(['garde'=>2]);
        return $this->render('medicale/index.html.twig', [
            'controller_name' => 'MedicaleController',
            'users' => $users,
            'garde' =>$garde,
            'reservations'=>$reservations,
            'gardeId'=>'2'
        ]);
    }


    /**
     * @Route("/sendData/med", name="med_send_data")
     */
    public function sendData(Request $request)
    {

        $this->forward('App\Controller\ReservationsController::processData', [
            'request'  => $request,
            'gardeID' => 2
        ]);


        return new JsonResponse(null, 200);
    }
}
