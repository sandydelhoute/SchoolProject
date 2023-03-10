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

    public function filter($categorie,$allergene,$priceMin,$priceMax,$offsetMin,$offsetMax,$relais){

    $qb = $this->createQueryBuilder('p')
        ->leftjoin('p.categories', 'c')
        ->addSelect('c')
        ->innerjoin('p.allergenes', 'a')
        ->addSelect('a')
        ->innerjoin('p.stock','s')
        ->addSelect('s')
        ->innerjoin('s.relais','r')
        ->addSelect('r')
        ->having('c.name IN (:categorie) and a.name NOT IN (:allergene) and p.prix > :prixentiermin and p.prix < :prixentiermax and r.id = :relais and s.quantity > 0 and p.active = true')
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


 public function findTableControlName($page, $nbMaxParPage,$order,$champ = null)
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

        if(is_null($champ))
        {
            $qb = $this->createQueryBuilder('u')
                ->orderBy('u.name',$order);
        }
        else
        {

            $qb = $this->createQueryBuilder('u')
                ->where("u.email LIKE :email or u.firstname LIKE :firstname or u.name LIKE :name ")
                ->orderBy('u.firstname',"DESC")
                ->setParameter(':email','%'.$champ.'%')
                ->setParameter(':firstname','%'.$champ.'%')
                ->setParameter(':name','%'.$champ.'%');
        }

        $query = $qb->getQuery();

        $premierResultat = ($page - 1) * $nbMaxParPage;
        $query->setFirstResult($premierResultat)->setMaxResults($nbMaxParPage);
        $paginator = new Paginator($query);

        if ( ($paginator->count() <= $premierResultat) && $page != 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas.'); // page 404, sauf pour la première page
        }

        return $paginator;
    }

   

     public function findTableControlEmail($page, $nbMaxParPage,$order,$champ = null)
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
        if(is_null($champ))
        {   
            $qb = $this->createQueryBuilder('u')
                ->orderBy('u.email',$order);
        }
        else
        {
            $qb = $this->createQueryBuilder('p')
                ->where("p.allergene LIKE :email or p.firstname LIKE :firstname or p.name LIKE :name ")
                ->setParameter(':email','%'.$champ.'%')
                ->setParameter(':firstname','%'.$champ.'%')
                ->setParameter(':name','%'.$champ.'%')
                ->orderBy('u.email',$order);
        }

        $query = $qb->getQuery();

        $premierResultat = ($page - 1) * $nbMaxParPage;
        $query->setFirstResult($premierResultat)->setMaxResults($nbMaxParPage);
        $paginator = new Paginator($query);

        if ( ($paginator->count() <= $premierResultat) && $page != 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas.'); // page 404, sauf pour la première page
        }

        return $paginator;
    }


}
