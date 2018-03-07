<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Genre;
use AppBundle\Entity\Movie;
use AppBundle\Entity\Review;
use AppBundle\Form\ReviewType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateIntervalType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class FilmController extends Controller
{
    public function homeAction()
    {
        return $this->render('/film/home.html.twig');
    }

    public function getAllAction(Request $request)
    {
        $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($defaultData)

            ->add('category', EntityType::class, array(
                'class' => Genre::class,
                'choice_label' => 'name',
                'label' => 'Catégorie'
            ))
            ->add('send', SubmitType::class,array(
                'attr' => array(
                    'class' => 'btn waves-effect waves-light'),
                'label' => 'Chercher les films'
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $category = $form["category"]->getData();
            $dateMin = $request->request->get('anneeMin');
            $dateMax = $request->request->get('anneeMax');

            $repo = $this->getDoctrine()->getRepository(Movie::class);
            $query = $repo->getFilmFiltered($category, $dateMin, $dateMax);
            $paginator  = $this->get('knp_paginator');

            $pagination = $paginator->paginate(
                $query, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                750/*limit per page*/
            );
            return $this->render('/film/all.html.twig', array(
                'pagination' => $pagination,
                'form' => $form->createView(),
                'currentYear' =>  date("Y"),
                'recherche' => [ "anneeMin"=> $dateMin, "anneeMax" => $dateMax, "genre"=>$category]
            ));

        }

        $repo = $this->getDoctrine()->getRepository(Movie::class);
        $query = $repo->findAllbyPagination();
        $paginator  = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            50/*limit per page*/
        );

        return $this->render('/film/all.html.twig', array(
            'pagination' => $pagination,
            'form' => $form->createView(),
            'currentYear' =>  date("Y")
            ));
    }

    public function getDetailAction(Request $request, $id){

        $review = new Review();
        $reviewForm = $this->createForm(ReviewType::class,  $review);
        $reviewForm->handleRequest($request);

        $repoFilm = $this->getDoctrine()->getRepository(Movie::class);
        $film = $repoFilm->findOneByImdbId($id);

        if($reviewForm->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $review->setMovie($film);
            $review->setUser($this->getUser());
            $em->persist($review);
            $em->flush();

            $this->addFlash("success", "votre idée a bien été enregistrée");
            return $this->redirectToRoute('getfilm',[
                "id"=> $film->getImdbId()
            ]);
        }

        return $this->render('/film/detail_film.html.twig',[
            "film"=> $film,
            "reviewForm" =>  $reviewForm->createView()
        ]);
    }
}
