<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FilmController extends Controller
{
    public function homeAction()
    {
        return $this->render('main.html.twig');
    }
}
