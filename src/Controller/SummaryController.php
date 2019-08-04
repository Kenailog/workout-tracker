<?php

namespace App\Controller;

use App\Entity\Activity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SummaryController extends AbstractController
{
    /**
     * @Route("/summary", name="summary")
     */
    public function index()
    {
        $activities = $this->getDoctrine()->getRepository(Activity::class)->findAll();
        $distance = 0;
        $kcal = 0;
        foreach ($activities as $activity) {
            $distance += $activity->getDistance();
            $kcal += $activity->getKcal();
        }
        return $this->render('summary/index.html.twig', [
            'distance' => $distance,
            'kcal' => $kcal,
        ]);
    }
}
