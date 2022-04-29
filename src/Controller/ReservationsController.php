<?php

namespace App\Controller;

use App\Entity\Garde;
use App\Entity\User;
use App\Entity\Reservations;
use App\Form\ReservationsType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationsController extends AbstractController
{
    /**
     * @Route("/reservations", name="reservations")
     */
    public function index(): Response
    {
        return $this->render('reservations/index.html.twig', [
            'controller_name' => 'ReservationsController',
        ]);
    }

    public function addReservations(Request $request) {
        $reservation = new Reservations();
        $form = $this->createForm(ReservationsType::class, $reservation);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservation->setDate();
            $reservation->setIsbooked();
            $reservation->setText();
            $reservation->setUserId();
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'ReservationsController'
        ]);
    }

    public function processData(Request $request, $gardeID){
        $users = $this->getDoctrine()->getRepository(User::class)->findBy(['gid' => $gardeID]);
        $location = $request->request->get('location');
        $reservations = $request->request->get('reservations');
        $currentmonth = $request->request->get('currentmonth');
        $currentYear = $request->request->get('currentYear');
        $garde = $this->getDoctrine()->getRepository(Garde::class)->findBy(['nom' => $location]);

        // start by comparing the data save with the data in database to see if there are any removed reservation
        foreach($users as $user){
            $checkReservationsByUser = $this->getDoctrine()->getRepository(Reservations::class)->findBy(['user_id' => $user->getId()]);

            if(isset($checkReservationsByUser)){
                foreach($checkReservationsByUser as $checkReservation){
                    foreach($reservations as $res){
                        // if all checkbox are unchecked
                        if(!(isset($res["dates"]))){
                            if($checkReservation->getUserId() == $user->getId() && $checkReservation->getDate()->format('m') === $currentmonth && $checkReservation->getDate()->format('Y') === $currentYear){
                                $entityManager = $this->getDoctrine()->getManager();
                                $entityManager->remove($checkReservation);
                                $entityManager->flush();
                            }
                        }
                        // then compare
                        if(isset($res["dates"]) && (int)$res["user"] === $user->getId() && $checkReservation->getDate()->format('m') === $currentmonth && $checkReservation->getDate()->format('Y') === $currentYear){
                            if(!(array_search($checkReservation->getDate()->format('d/m/Y'), $res["dates"]))){
                                $entityManager = $this->getDoctrine()->getManager();
                                $entityManager->remove($checkReservation);
                                $entityManager->flush();
                            }
                        }
                    }
                }
            }
        }

        // then update database with new saved reservations
        foreach($reservations as $res){
            if(isset($res["dates"])){
                foreach($res["dates"] as $date){
                    $arrayDate = explode("/", $date);
                    $transformDate = [$arrayDate[1], $arrayDate[0], $arrayDate[2]];
                    $newDate = implode("/", $transformDate);

                    $checkReservations = $this->getDoctrine()->getRepository(Reservations::class)->findBy(['user_id' => $res["user"], 'date'=>new \DateTime($newDate)]);
                    if(!$checkReservations){
                        $reservation = new Reservations;
                        $reservation->setIsbooked(true)
                            ->setUserId($res["user"])
                            ->setDate(new \DateTime($newDate))
                            ->setGarde($garde[0])
                            ->setText("x");

                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($reservation);
                        $entityManager->flush();
                    }
                }
            }
        }
    }
}
