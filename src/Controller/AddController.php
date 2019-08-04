<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Activity;
use App\Form\NewActivityType;
use Symfony\Component\HttpFoundation\Request;

class AddController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function index(Request $request)
    {
        $activity = new Activity();
        $form = $this->createForm(NewActivityType::class, $activity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($activity);
            $entityManager->flush();
            return $this->redirectToRoute('show');
        }

        return $this->render('add/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
