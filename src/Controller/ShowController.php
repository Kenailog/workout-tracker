<?php

namespace App\Controller;

use App\Form\NewActivityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/show/{id}/edit", name="edit")
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function edit(Request $request, $id) {
        $activity = $this->getDoctrine()->getRepository(Activity::class)->find($id);
        $form = $this->createForm(NewActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('show');
        }

        return $this->render('add/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
