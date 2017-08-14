<?php

namespace Core\CoreBundle\Service\TimeOut;


use Symfony\Component\Security\Http\Logout\DefaultLogoutSuccessHandler;
use Symfony\Component\Security\Http\HttpUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

use Doctrine\ORM\EntityManager;

class TimeOut extends DefaultLogoutSuccessHandler
{
 
    private  $em , $tokenStorage ;
    protected $targetUrl;
 
    public function __construct(HttpUtils $httpUtils,EntityManager $em,TokenStorage $tokenStorage)
    {
    	parent::__construct($httpUtils);
        $this->em = $em;
        $this->tokenStorage=$tokenStorage;
    }

  	public function onLogoutSuccess(Request $Request)
  	{
  		$relaisId= $this->tokenStorage->getToken()->getUser()->getRelais()->getId();
  		$listOrderLiner=$Request->getSession()->get('panier');

  		if(!is_null($listOrderLiner))
  		{

  			foreach ($listOrderLiner as $key => $orderLine) {


  				foreach ($orderLine->getProduct()->getStock() as $key => $stock) {
  					if($stock->getRelais()->getId() == $relaisId)
  					{
  					
  					$newStock=$stock->setQuantity($stock->getQuantity()+$orderLine->getQuantity());

  					$this->em->merge($newStock);

  					}

  				}
  			}
  		}
  	$this->em->flush();
    $response = parent::onLogoutSuccess($Request);
    return $response;
    }

}