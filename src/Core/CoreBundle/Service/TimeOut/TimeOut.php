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
  		$relais= $this->tokenStorage->getToken()->getUser()->getRelais();
  		$listOrderLiner=$Request->getSession()->get('panier');
      $listeStock=$this->em->getRepository('CoreCoreBundle:Stock')->findByRelais($relais);
     

    	if(!is_null($listOrderLiner))
  		{


  			foreach ($listOrderLiner as $key => $orderLine) {
          foreach ($listeStock as $key => $stock) {

            if($stock->getProduct()->getId() == $orderLine->getProduct()->getId())
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