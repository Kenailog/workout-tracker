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
        $records = $this->getDoctrine()->getRepository(Activity::class)->findAll();
        return $this->render('show/index.html.twig', [
            'records' => $records
        ]);
    }

    /**
     * @Route("/show/{id}", name="show_details")
     */
    public function details()
    {
        return $this->render('show/details.html.twig', [
            'type' => 'run',
            'duration' => '01:00:25',
            'kcal' => 825,
            'date' => '12-17-2019',
        ]);
    }
}
