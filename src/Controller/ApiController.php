<?php

namespace App\Controller;

use App\Entity\Calendar;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     */
    public function index(): Response
    {
        return $this->render('api/index.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }

    /**
     * @Route("/api/{id}/edit", name="api_event_edit", methods={"PUT"})
     * @throws \Exception
     */
     public function majEvent(?Calendar $calendar, Request $request)
     {
         //récupération des données envoyées par FC
         $donnees = json_decode($request->getContent());

         //vérification des données
         if(
             isset($donnees->title) && !empty($donnees->title)&&
             isset($donnees->start) && !empty($donnees->start)&&
             isset($donnees->end) && !empty($donnees->end)
         ){
             //données complètes
             //initialisation d'un code de reponse
             $code = 200; //mise à jour OK

             /*
             //on vérifie si l'id existe déjà
             if(!$calendar){
                 //s'il n'existe pas, on créé un rdv
                 $calendar = new Calendar;

                 //on change le code
                 $code = 201; //créatiion ok
             }*/

             $calendar->setTitle($donnees->title);
             $calendar->setStart(new \DateTime($donnees->start));
             $calendar->setEnd(new \DateTime($donnees->end));
             $calendar->setDescription($donnees->description);
             $calendar->setAllDay($donnees->allDay);

             //ajout de l'entity manager
             $em = $this ->getDoctrine()->getManager();
             $em->persist($calendar);
             $em->flush();

             return new Response('Ok', $code);
         } else {
             //données incomplètes
             return new Response('Données incomplètes', 404);
         }
        /*
         return $this->render('api/index.html.twig', [
        'controller_name' => 'ApiController',
        ]);*/
     }
}
