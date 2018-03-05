<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FilmController extends Controller
{
    public function homeAction()
    {
        return $this->render('/film/home.html.twig');
    }

    public function getAllAction()
    {
        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $films = $repo->findAll();
        var_dump($films);
        die();
    }
}
