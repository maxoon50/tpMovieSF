<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\WishedFilm", mappedBy="user")
     *
     */
    private $wishedList;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Review", mappedBy="user")
     *
     */
    private $reviews;

    /**
     * Add review
     *
     * @param \AppBundle\Entity\Review $review
     *
     * @return User
     */
    public function addReview(\AppBundle\Entity\Review $review)
    {
        $this->reviews[] = $review;

        return $this;
    }

    /**
     * Remove review
     *
     * @param \AppBundle\Entity\Review $review
     */
    public function removeReview(\AppBundle\Entity\Review $review)
    {
        $this->reviews->removeElement($review);
    }

    /**
     * Get reviews
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    /**
     * Add wishedList
     *
     * @param \AppBundle\Entity\WishedFilm $wishedList
     *
     * @return User
     */
    public function addWishedList(\AppBundle\Entity\WishedFilm $wishedList)
    {
        $this->wishedList[] = $wishedList;

        return $this;
    }

    /**
     * Remove wishedList
     *
     * @param \AppBundle\Entity\WishedFilm $wishedList
     */
    public function removeWishedList(\AppBundle\Entity\WishedFilm $wishedList)
    {
        $this->wishedList->removeElement($wishedList);
    }

    /**
     * Get wishedList
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWishedList()
    {
        return $this->wishedList;
    }
}
