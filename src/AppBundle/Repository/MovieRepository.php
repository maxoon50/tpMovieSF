<?php

namespace AppBundle\Repository;



/**
 * MovieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MovieRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllbyPagination()
    {
        $qb = $this->createQueryBuilder('m');
        $qb->addSelect('m')
            ->addOrderBy('m.title', 'ASC')
        ;
        $query = $qb->getQuery();

        return $query;
    }


    public function getFilmFiltered($genre, $dateMin, $dateMax)
{
    $qb = $this->createQueryBuilder('m');
    $qb->addSelect('m')
        ->addOrderBy('m.title', 'ASC');
    $qb->andWhere('m.year BETWEEN :dateMin AND :dateMax')
        ->setParameter('dateMin', $dateMin)
        ->setParameter('dateMax', $dateMax);

    $qb->join("m.genres", "g")
        ->addSelect('g')
        ->andWhere('g = :genre')
        ->setParameter("genre", $genre);




    $query = $qb->getQuery();

    return $query;
}

    public function getFilmByPeople($imdbId)
    {
        $qb = $this->createQueryBuilder('m');
        $qb->addSelect('m')
            ->addOrderBy('m.title', 'ASC');

        $qb->join("m.directors", "d")
            ->join("m.actors", "a")
            ->addSelect('d')
            ->addSelect('a')
            ->andWhere('d.imdbId= :imdbId')
            ->orWhere('a.imdbId= :imdbId')
            ->setParameter("imdbId", $imdbId);

        $query = $qb->getQuery();
        return $query;

    }


}
