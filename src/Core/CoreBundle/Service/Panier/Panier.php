<?php

namespace Core\CoreBundle\Service\Panier;

class Panier
{
    public function total(Array $listOrderLine = null)
    {

    	if(is_null($listOrderLine))
    		return 0 ; 

    	$total = 0;
    	$countBoisson=0;
    	$countPlat=0;
    	$countEntree=0;
    	$countDessert=0;
    	$arrayPlat=array();
    	$arrayDessert=array();
    	$arrayBoisson=array();
    	$arrayEntree=array();
    	$origineTotal = 0 ; 
 

        foreach ($listOrderLine as $orderLine) {
        	$origineTotal += $orderLine->getPrix() * $orderLine->getQuantity();
        	foreach ($orderLine->getProduct()->getCategories() as $categorie) {
        	
	        	if($categorie->getName()=="Boisson")
	        	{
	        		$boisson=$orderLine->getProduct();
	    			$countBoisson += $orderLine->getQuantity();
	    			for($i=0;$i<$orderLine->getQuantity();$i++)
	    			{
	    				array_push($arrayBoisson,$orderLine->getProduct()->getPrix());
	    			}
	        	}
	        		if($categorie->getName()=="Plat")
	        	{
    			    $plat=$orderLine->getProduct();
	        		$countPlat += $orderLine->getQuantity();
	        		for($i=0;$i<$orderLine->getQuantity();$i++)
	    			{
	    				array_push($arrayPlat,$orderLine->getProduct()->getPrix());
	    			}
	        	}
	        		if($categorie->getName()=="Entrée")
	        	{
	        		for($i=0;$i<$orderLine->getQuantity();$i++)
	    			{
	    				array_push($arrayEntree,$orderLine->getProduct()->getPrix());
	    			}
	        		$entre=$orderLine->getProduct();
	        		$countEntree += $orderLine->getQuantity();
	        	}
	        		if($categorie->getName()=="Dessert")
	        	{
	        		$dessert=$orderLine->getProduct();
	        		$countDessert += $orderLine->getQuantity();
	        		for($i=0;$i<$orderLine->getQuantity();$i++)
	    			{
	    				array_push($arrayDessert,$orderLine->getProduct()->getPrix());
	    			}
	        	}
        	}
	        
        }
        asort($arrayBoisson);
        asort($arrayEntree);
        asort($arrayPlat);
        asort($arrayDessert);
        if($countEntree >= 1 & $countDessert >= 1 & $countBoisson >= 1 & $countPlat >= 1)
	    {
        	$minCount=min($countPlat,$countEntree,$countBoisson);
	    	$total= 16 * $minCount;
	    	$arrayBoisson=$this->deletteArray($arrayBoisson,$minCount);
	    	$arrayEntree=$this->deletteArray($arrayEntree,$minCount);
	    	$arrayPlat=$this->deletteArray($arrayPlat,$minCount);
	    	$arrayDessert=$this->deletteArray($arrayDessert,$minCount);
	    	$total += $this->subTotal($arrayEntree)+$this->subTotal($arrayPlat)+$this->subTotal($arrayBoisson)+$this->subTotal($arrayDessert);
	    }
	    else if($countEntree >= 1 & $countBoisson >=1 & $countPlat >= 1)
	    {
        	$minCount=min($countPlat,$countEntree,$countBoisson);
	    	$total= 14 * $minCount;
	    	$arrayBoisson=$this->deletteArray($arrayBoisson,$minCount);
	    	$arrayEntree=$this->deletteArray($arrayEntree,$minCount);
	    	$arrayPlat=$this->deletteArray($arrayPlat,$minCount);
	    	$total += $this->subTotal($arrayEntree)+$this->subTotal($arrayPlat)+$this->subTotal($arrayBoisson);

	    }
	    else if($countDessert >= 1 & $countBoisson >= 1 & $countPlat >= 1 )
	    {
        	$minCount=min($countPlat,$countEntree,$countBoisson);
	    	$total= 12 * $minCount;
	    	$arrayBoisson=$this->deletteArray($arrayBoisson,$minCount);
	    	$arrayDessert=$this->deletteArray($arrayDessert,$minCount);
	    	$arrayPlat=$this->deletteArray($arrayPlat,$minCount);
	    	$total += $this->subTotal($arrayDessert)+$this->subTotal($arrayPlat)+$this->subTotal($arrayBoisson);	    }
	    else
	    {
	    	foreach ($listOrderLine as $key => $orderLine) {	
	    		$total+=$orderLine->getQuantity()*$orderLine->getPrix();
	    	}
	    }
	    if($total<$origineTotal)
       		return $total;
   		else
   			return $origineTotal;
    }

    private function deletteArray($array,$count){
    	for($i = 0 ;$i < $count ; $i ++)
    	{
    		unset($array[$i]);
    	}
    	return $array;
    }

 	private function subTotal($array){
 		$subTotal = 0;
 		foreach ($array as $key=>$price) {
 			$subTotal +=$price;
 		}
 		return $subTotal;

 	}
} 