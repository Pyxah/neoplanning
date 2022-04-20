<?php

namespace App\Controller;

use App\Repository\CalendarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(CalendarRepository $calendar)
    {
        $events = $calendar->findAll(); //récupération des event

        $rdv = []; //on initialise un tableau vide dans lequel on va mettre les éléments parsés
        foreach ($events as $event){
            $rdv[] = [
              'id' => $event->getId(),
              'title' => $event->getTitle(),
              'start' => $event->getStart()->format('Y-m-d H:i:s'),
              'end' => $event->getEnd()->format('Y-m-d H:i:s'),
              'description' => $event->getDescription(),
              'allDay' => $event->getAllDay(),
            ];
        }

        $data = json_encode($rdv); //on encode notre tableau en json pour qu'il soit exploitable par FullCalendar

        return $this->render('home/index.html.twig', compact('data'));
    }
}
