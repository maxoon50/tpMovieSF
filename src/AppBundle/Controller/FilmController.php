<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FilmController extends Controller
{
    public function homeAction()
    {
        return $this->render('/film/home.html.twig');
    }

    public function getAllAction(Request $request)
    {
        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $query = $repo->findAllbyPagination();
        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            50/*limit per page*/
        );

        return $this->render('/film/all.html.twig', array('pagination' => $pagination));

    }
}
