<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use AppBundle\Entity\WishedFilm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WishedController extends Controller
{
    public function addAction($id)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $film  = $repo->findByImdbId($id);

        $wishedFilm = new WishedFilm();
        $wishedFilm->setUser($this->getUser());
        $wishedFilm->setMovies($film[0]);

        $em = $this->getDoctrine()->getManager();
        $em->persist($wishedFilm);
        $em->flush();

        return $this->json(array(
            'result' => 'OK',
            'error' => 'none'
            ));
    }

    public function removeAction($id)
    {
        $this->denyAccessUnlessGranted("ROLE_USER");

        $repoFilm = $this->getDoctrine()->getRepository(Movie::class);
        $film  = $repoFilm->findByImdbId($id);

        $repoWished = $this->getDoctrine()->getRepository(WishedFilm::class);
        $wishedFilm =  $repoWished->findOneBy([
            "movies" => $film,
            "user" => $this->getUser()
        ]);

        $em = $this->getDoctrine()->getManager();
        $em->remove($wishedFilm);
        $em->flush();

        return $this->json(array(
            'result' => 'OK',
            'error' => 'none'
        ));
    }
}
