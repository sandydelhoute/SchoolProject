<?php

namespace Core\CoreBundle\Repository;

/**
 * PostsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PostsRepository extends \Doctrine\ORM\EntityRepository
{
	public function scrollPosts($offsetmin,$offsetmax){

    $qb = $this->createQueryBuilder('p')
   ->setFirstResult( $offsetmin )
   ->setMaxResults( $offsetmax )
   ->add('orderBy', 'p.datepublish DESC');



    $query = $qb->getQuery();
    $results = $query->getResult();
    return $results;
	}
}
