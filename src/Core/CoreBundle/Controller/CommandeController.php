<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class CommandeController extends Controller
{
     public function commandeAction(Request $request)
    {
    	$session = $request->getSession();
    	$em = $this->getDoctrine()->getManager();
		$listOrderLine=$session->get('panier');
		if($listOrderLine != null)
		foreach ($listOrderLine as $orderline) {
					$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($orderline->getProduct()->getId());
				$orderline->setProduct($product);
		}
        return $this->render('CoreCoreBundle:Commande:commandelayout.html.twig',array('listOrderLine'=>$listOrderLine));
    }

}
