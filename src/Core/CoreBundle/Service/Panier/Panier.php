<?php

namespace Core\CoreBundle\Service\Panier;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
class Panier
{
  
  public function __construct()
    {

    }


    public function total(Array $listOrderLine = null)
    {

    	if(is_null($listOrderLine))
    		return 0 ; 

    	$total = 0;
    	$plat;
    	$boisson;
    	$dessert;
    	$entre;
    	$countBoisson=0;
    	$countPlat=0;
    	$countEntree=0;
    	$countDessert=0;
    	$arrayMenu1 = [];
    	$arrayMenu2 = [];
    	$arrayMenu3 = [];
    	$arrayMenu4 = [];

        foreach ($listOrderLine as $orderLine) {
        
        	foreach ($orderLine->getProduct()->getCategories() as $categorie) {
        	
	        	if($categorie->getName()=="Boisson")
	        	{
	        		$boisson=$orderLine->getProduct();
	    			$countBoisson += 1;
	        	}
	        		if($categorie->getName()=="Plat")
	        	{
    			    $plat=$orderLine->getProduct();
	        		$countPlat +=1;
	        	}
	        		if($categorie->getName()=="Entree")
	        	{
	        		$entre=$orderLine->getProduct();
	        		$countEntree += 1;
	        	}
	        		if($categorie->getName()=="Dessert")
	        	{
	        		$dessert=$orderLine->getProduct();
	        		$countDessert += 1;
	        	}
	
        	}
	        if($countBoisson == 1 & $countPlat == 1 & $countDessert == 1 & $countEntree == 1)
	        {
		    	$countBoisson = 0 ;
		    	$countPlat = 0;
		    	$countDessert = 0;	
		    	$countEntree=0;
		    	$total+=15;
		    	$this->deletteArray($boisson,$listOrderLine);
		    	$this->deletteArray($plat,$listOrderLine);
		    	$this->deletteArray($dessert,$listOrderLine);
		    	$this->deletteArray($entre,$listOrderLine);
	        }
	        else if($countBoisson == 1 & $countPlat == 1 & $countDessert == 1)
	        {
		    	$countBoisson = 0 ;
		    	$countPlat = 0;
		    	$countDessert = 0;
		    	$this->deletteArray($boisson,$listOrderLine);
		    	$this->deletteArray($plat,$listOrderLine);
		    	$this->deletteArray($dessert,$listOrderLine);
		    	$total+=13;

	        }
	        else if($countBoisson == 1 & $countPlat == 1 & $countEntree == 1){
		    	$countBoisson = 0 ;
		    	$countPlat = 0;
		    	$countEntree = 0;
		    	$this->deletteArray($boisson,$listOrderLine);
		    	$this->deletteArray($plat,$listOrderLine);
		    	$this->deletteArray($entre,$listOrderLine);
		    	$total+=12;
	        }
	        else
	        {
	        	//push_array($orderLine,$arrayProduct);
	        }
        }
        foreach ($listOrderLine as $orderLine) {
        	//$total += $orderLine->getProduct()->getPrix();
        }
        
       return $total;
    }

    private function deletteArray($product,$listOrderLine){
    	foreach ($listOrderLine as $orderLine) {    			
    		if($orderLine->getProduct()->getId()==$product->getId())
    		{
    		// 	var_dump($orderLine->getQuantity());    			
    		// 		$orderLine->setQuantity()=1;
    		// 		//$orderLine->getQuantity()-
    			
    		// 	else
    		// 	{
    		// 		unset($orderLine);
    		// 	}
    		}
    	}
    }
 
} 