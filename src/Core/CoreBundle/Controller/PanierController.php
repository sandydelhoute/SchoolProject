<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Core\CoreBundle\Entity\OrderLine;

class PanierController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     */
	public function panierAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$session = $request->getSession();
		$listOrderLine=$session->get('panier');

		if(!is_null($listOrderLine))
		{
			foreach ($listOrderLine as $orderline) {
	
				{
				$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($orderline->getProduct()->getId());
				$orderline->setProduct($product);
				}
			
			}
		}
		$total=$this->container->get('panier')->total($listOrderLine);
		return $this->render('CoreCoreBundle:Commande:panierlayout.html.twig',array('listOrderLine'=>$listOrderLine,'total'=>$total));
		}

		public function addProductsAction($id,$quantity,Request $request)
		{
			    
			 if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
        		throw $this->createAccessDeniedException();
    		}
    		$newStock;
			$session = $request->getSession();
			$serializer=$this->get('serializer');
			$em = $this->getDoctrine()->getManager();	
			$lineorder=new OrderLine();
			$lineorder->setQuantity($quantity);
			$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($id);
			$lineorder->setProduct($product);
			$lineorder->setPrix($product->getPrix());
			$listStock=$this->getUser()->getRelais()->getStock();
			foreach ($listStock as $key => $stockliner) {
				if($stockliner->getProduct()->getId() == $product->getId())
				{
					$newStock =$stockliner->setQuantity($stockliner->getQuantity()-$quantity);
					$em->persist($newStock);

				}

			}
			$em->flush();			
			$listOrderLine=$session->get('panier');
			if($listOrderLine != null)
			{ 
				$produitExist=false;
				foreach ($listOrderLine as $key => $value) {
					if($value->getProduct()->getId() == $lineorder->getProduct()->getId())
					{
						$produitExist=true;
						break;	
					}
				}
				if($produitExist)
				{
					foreach ($listOrderLine as $key => $value)
					{
						if($value->getProduct()->getId() == $lineorder->getProduct()->getId())
						{
						$value->setQuantity($value->getQuantity()+$quantity);
						break;
						}
					}
				}
				else
				{
					array_push($listOrderLine,$lineorder);
				}
				$session->set('panier',$listOrderLine);

				
			}
			else
			{	
				$listOrderLine=array($lineorder);

				$session->set('panier',$listOrderLine);
			}


			$response = new JsonResponse(array('response'=>true,'paniercount'=>count($listOrderLine),'stock'=>$newStock->getQuantity())
				);
			return $response ;

		}
		public function deleteProductsAction($id,Request $request){
			$session = $request->getSession();
			$quantity=0;
			$em = $this->getDoctrine()->getManager();
			$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($id);
			$listOrderLine=$session->get('panier');
			foreach ($listOrderLine as $key => $value)
			{	
					if($value->getProduct()->getId() == $product->getId())
					{
						$quantity=$value->getQuantity();
						unset($listOrderLine[$key]);
						$session->set('panier',$listOrderLine);
						break;
					}

				}
				$listStock=$this->getUser()->getRelais()->getStock();
				foreach ($listStock as $key => $stockliner) {
					if($stockliner->getProduct()->getId() == $product->getId())
					{
						$newStock =$stockliner->setQuantity($stockliner->getQuantity()+$quantity);
						$em->persist($newStock);
						$em->flush();
					}

				}
			$total=$this->container->get('panier')->total($listOrderLine);
			$ptsfidelite=round($total/10, 2);
			$response = new JsonResponse(
				array('total'=>$total,'ptsfidelite'=>$ptsfidelite,'panniercount'=>count($listOrderLine))
				);
			return $response ;

		}
		public function changeQuantityAction($id,$quantity,Request $request){
			$session = $request->getSession();
			$em = $this->getDoctrine()->getManager();
			$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($id);
			$listOrderLine=$session->get('panier');
			$quantityBefore= 0 ;
			$listStock=$this->getUser()->getRelais()->getStock();
			
			foreach ($listOrderLine as $key => $value) {
				if($value->getProduct()->getId() == $product->getId())
				{
					$quantityBefore=$value->getQuantity();
					$value->setQuantity($quantity);
				}
			}
			foreach ($listStock as $key => $stockliner) {
				if($stockliner->getProduct()->getId() == $product->getId())
				{
					if($quantityBefore<$quantity)
					{
						$currentQuantity=$quantity-$quantityBefore;
						$newStock =$stockliner->setQuantity($stockliner->getQuantity()-$currentQuantity);
					}
					else
					{
						$currentQuantity=$quantityBefore-$quantity;
						$newStock =$stockliner->setQuantity($stockliner->getQuantity()+$currentQuantity);
					}

					$em->persist($newStock);
					$em->flush();
					break;
				}

			}
			$total=$this->container->get('panier')->total($listOrderLine);
			$ptsfidelite=round($total/10, 2);
			$session->set('panier',$listOrderLine);
			$response = new JsonResponse(
				array('total'=>$total,'ptsfidelite'=>$ptsfidelite)
				);
			return $response ;

		}
	}