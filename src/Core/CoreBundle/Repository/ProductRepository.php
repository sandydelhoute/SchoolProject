<?php

namespace Core\CoreBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
use Doctrine\ORM\Tools\Pagination\Paginator;

class ProductRepository extends \Doctrine\ORM\EntityRepository
{


 public function findAllPagineEtTrie($page, $nbMaxParPage)
    {
        if (!is_numeric($page)) {
            throw new InvalidArgumentException(
                'La valeur de l\'argument $page est incorrecte (valeur : ' . $page . ').'
            );
        }

        if ($page < 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        if (!is_numeric($nbMaxParPage)) {
            throw new InvalidArgumentException(
                'La valeur de l\'argument $nbMaxParPage est incorrecte (valeur : ' . $nbMaxParPage . ').'
            );
        }
    
        $qb = $this->createQueryBuilder('p');
        
        $query = $qb->getQuery();

        $premierResultat = ($page - 1) * $nbMaxParPage;
        $query->setFirstResult($premierResultat)->setMaxResults($nbMaxParPage);
        $paginator = new Paginator($query);

        if ( ($paginator->count() <= $premierResultat) && $page != 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas.'); // page 404, sauf pour la première page
        }

        return $paginator;
    }
public function filterProduct($categorie,$allergene,$priceMin,$priceMax){

    $qb = $this->createQueryBuilder('p')
    ->join('p.categories', 'c')
    ->addSelect('c')
    ->innerjoin('p.allergenes', 'a')
    ->addSelect('a')
    ->having('c.name IN (:categorie) and a.name NOT IN (:allergene)  and p.prix > :prixentiermin and p.prix < :prixentiermax' )
    ->setParameter('allergene', $allergene)
    ->setParameter('categorie',$categorie)
    ->setParameter('prixentiermin',$priceMin)
    ->setParameter('prixentiermax', $priceMax);


    $query = $qb->getQuery();
    $results = $query->getResult();
    return $results;



}


}
