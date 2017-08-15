<?php

namespace Vendor\ConnectUsersBundle\Repository;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * UsersEmployeeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UsersEmployeeRepository extends \Doctrine\ORM\EntityRepository 
{

	 public function findTableControl($orderSelect,$order,$champ = null)
    {
       
    
        if(!is_null($champ))
        {
        $qb = $this->createQueryBuilder('u')
        ->leftjoin('u.status', 's')
        ->addSelect('s')
        ->having('u.email like "%(:$champ)%" order by (:orderSelect) (:order)') 
        ->setParameter('champ',$champ)
        ->setParameter('orderSelect', $orderSelect)
        ->setParameter('order',$order);
        }
        else
        {$qb = $this->createQueryBuilder('u')
        ->leftjoin('u.status', 's')
        ->addSelect('s')
        ->having('order by (:orderSelect) (:order)')
        ->setParameter('orderSelect', $orderSelect)
        ->setParameter('order',$order);
        }
  
    $query = $qb->getQuery();
    $results = $query->getResult();
    return $results;
    }




}
