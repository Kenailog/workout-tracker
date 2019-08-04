<?php

namespace App\Controller;

use App\Entity\Activity;
use App\Form\NewActivityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/update{id}", name="update.")
 */
class UpdateController extends AbstractController
{
    /**
     * @Route("/remove", name="remove")
     * @param $id
     * @return Response
     */
    public function remove($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($this->getDoctrine()->getRepository(Activity::class)->find($id));
        $entityManager->flush();
        return $this->redirectToRoute('show');
    }

    /**
     * @Route("/edit", name="edit")
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
