<?php

namespace Core\CoreBundle\Repository;

/**
 * MenuRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MenuRepository extends \Doctrine\ORM\EntityRepository
{


    public function filter($categorie,$allergene,$priceMin,$priceMax,$offsetMin,$offsetMax,$relais){

    $qb = $this->createQueryBuilder('m')
    	->join('m.product','p')
    	->addSelect('p')
        ->leftjoin('p.categories', 'c')
        ->addSelect('c')
        ->innerjoin('p.allergenes', 'a')
        ->addSelect('a')
        ->innerjoin('m.stock','s')
        ->addSelect('s')
        ->innerjoin('s.relais','r')
        ->addSelect('r')
        ->having('c.name IN (:categorie) and a.name NOT IN (:allergene) and m.prix > :prixentiermin and m.prix < :prixentiermax and r.id = :relais and s.quantity > 0 and m.active = true and p.active = true')
        ->setParameter('allergene', $allergene)
        ->setParameter('categorie',$categorie)
        ->setParameter('prixentiermin',$priceMin)
        ->setParameter('prixentiermax', $priceMax)
        ->setParameter('relais', $relais->getId())
        ->setFirstResult($offsetMin)
        ->setMaxResults($offsetMax); 


    $query = $qb->getQuery();
    $results = $query->getResult();
    return $results;

}

}
