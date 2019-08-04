<?php

namespace App\Controller;

use App\Entity\Activity;
use Doctrine\Common\Collections\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $search = $request->query->get('search');
        $repository = $this->getDoctrine()->getRepository(Activity::class);
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('id', intval($search)))
            ->orWhere(Criteria::expr()->lte('distance', intval($search) + 1000))
            ->andWhere(Criteria::expr()->gte('distance', intval($search) - 1000))
            ->orWhere(Criteria::expr()->contains('type', $search));
        $records = $repository->matching($criteria);

        return $this->render('show/index.html.twig', [
            'records' => $records,
        ]);
    }
}
