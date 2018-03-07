<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * WishedFilm
 *
 * @ORM\Table(name="wished_film")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WishedFilmRepository")
 */
class WishedFilm
{

    public function __construct()
    {
        $this->addedAt = new \DateTime();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User" , inversedBy="wishedList")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var Movies
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Movie" , inversedBy="wished")
     * @ORM\JoinColumn(nullable=false)
     */
    private $movies;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="addedAt", type="datetime")
     */
    private $addedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set addedAt
     *
     * @param \DateTime $addedAt
     *
     * @return WishedFilm
     */
    public function setAddedAt($addedAt)
    {
        $this->addedAt = $addedAt;

        return $this;
    }

    /**
     * Get addedAt
     *
     * @return \DateTime
     */
    public function getAddedAt()
    {
        return $this->addedAt;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return WishedFilm
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set movies
     *
     * @param \AppBundle\Entity\Movie $movies
     *
     * @return WishedFilm
     */
    public function setMovies(\AppBundle\Entity\Movie $movies)
    {
        $this->movies = $movies;

        return $this;
    }

    /**
     * Get movies
     *
     * @return \AppBundle\Entity\Movie
     */
    public function getMovies()
    {
        return $this->movies;
    }
}
