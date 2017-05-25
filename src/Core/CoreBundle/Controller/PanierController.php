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
		if($listOrderLine != null)
			foreach ($listOrderLine as $orderline) {
	
				if(!is_null($orderline->getProduct()))
				{
				$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($orderline->getProduct()->getId());
				$orderline->setProduct($product);
				}
				else
				{
					$menu= $em->getRepository('CoreCoreBundle:Menu')->findOneById($orderline->getMenu()->getId());
					$orderline->setMenu($menu);
				}
			}
			return $this->render('CoreCoreBundle:Commande:panierlayout.html.twig',array('listOrderLine'=>$listOrderLine));
		}

		public function addProductsAction($id,$quantity,$type,Request $request)
		{
			$session = $request->getSession();
			$serializer=$this->get('serializer');
			$em = $this->getDoctrine()->getManager();
			$relaisId=$this->getUser()->getRelais()->getId();
			//$relais=$em->getRepository('CoreCoreBundle:Relais')->findOneById($relaisId);
			// $date=new \Date();
			// var_dump($date);
			//var_dump($this->getUser()->getRelais()->getId());
			//exit;
			$lineorder=new OrderLine();
			$lineorder->setQuantity($quantity);
			if($type == 'product')
			{
				$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($id);
				$lineorder->setProduct($product);
				$lineorder->setPrix($product->getPrix());
			}
			else
			{
				$menu= $em->getRepository('CoreCoreBundle:Menu')->findOneById($id);
				$lineorder->setMenu($menu);
				$lineorder->setPrix($menu->getPrix());
			}


			$listOrderLine=$session->get('panier');
			if($listOrderLine != null)
			{ 
				$productexit=true;
				foreach ($listOrderLine as $key => $value) {

					if($type ==='product')
					{
						if(!is_null($value->getProduct()))
						if($value->getProduct()->getId() == $lineorder->getProduct()->getId())
						{
								$value->setQuantity($value->getQuantity()+$quantity);
								$session->set('panier',$listOrderLine);
								$productexit=false;
								break;
						}
					}
					else
					{
						if(!is_null($value->getMenu()))
						if($value->getMenu()->getId() == $lineorder->getMenu()->getId())
						{
							$value->setQuantity($value->getQuantity()+$quantity);
							$session->set('panier',$listOrderLine);
							$productexit=false;
							break;
						}
					}
				}
				if($productexit)
				{
					array_push($listOrderLine,$lineorder);
					$session->set('panier',$listOrderLine);
				}
				
			}
			else
			{
				$session->set('panier',array($lineorder));
			}


			$response = new JsonResponse(array('response'=>true,'paniercount'=>count($listOrderLine))
				);
			return $response ;

		}
		public function deleteProductsAction($id,$type,Request $request){
			$session = $request->getSession();
			$em = $this->getDoctrine()->getManager();
			if($type === 'product')
			{
			$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($id);
			}
			else
			{
				$menu= $em->getRepository('CoreCoreBundle:Menu')->findOneById($id);
			}
			$listOrderLine=$session->get('panier');
			foreach ($listOrderLine as $key => $value) {
				if($type === 'product')
				{
					if(!is_null($value->getProduct()))
					{
						if($value->getProduct()->getId() == $product->getId())
						{
							unset($listOrderLine[$key]);
						}
					}
				}
				else
				{
					if(!is_null($value->getMenu()))
					{
						if($value->getMenu()->getId() == $menu->getId())
						{
							unset($listOrderLine[$key]);
						}
					}
					

				}
			
			}
			$total=0;
			foreach ($listOrderLine as $key => $value) {
				if(!is_null($value->getProduct()))
				{
					$total += $value->getQuantity()*$value->getProduct()->getPrix();
				}
				else
				{
					$total += $value->getQuantity()*$value->getMenu()->getPrix();
				}
			}


			$ptsfidelite=round($total/10, 2);
			$session->set('panier',$listOrderLine);
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
			$total=0;
			foreach ($listOrderLine as $key => $value) {
				if($value->getProduct()->getId() == $product->getId())
				{
					$value->setQuantity($quantity);
				}
			
					$total += $value->getQuantity()*$value->getProduct()->getPrix();
			}
			$ptsfidelite=round($total/10, 2);
			$session->set('panier',$listOrderLine);
			$response = new JsonResponse(
				array('total'=>$total,'ptsfidelite'=>$ptsfidelite)
				);
			return $response ;

		}
	}