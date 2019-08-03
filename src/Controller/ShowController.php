<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Activity;

class ShowController extends AbstractController
{
    /**
     * @Route("/show", name="show")
     */
    public function index()
    {
        // $em = $this->getDoctrine()->getManager();

        // $activity = new Activity();
        // $activity->setType("run")->setDuration(new \DateTime("01:00:25"))->setKcal(825)->setDate(new \DateTime('12-17-2019'));
        // $em->persist($activity);
        // $em->flush();

        return $this->render('show/index.html.twig', [
            'type' => 'run',
            'duration' => '01:00:25',
            'kcal' => 825,
            'date' => '12-17-2019',
        ]);
    }
}
