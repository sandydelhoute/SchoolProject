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
	
				{
				$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($orderline->getProduct()->getId());
				$orderline->setProduct($product);
				}
			
			}
		$total=$this->container->get('panier')->total($listOrderLine);
			return $this->render('CoreCoreBundle:Commande:panierlayout.html.twig',array('listOrderLine'=>$listOrderLine,'total'=>$total));
		}

		public function addProductsAction($id,$quantity,Request $request)
		{
			$session = $request->getSession();
			$serializer=$this->get('serializer');
			$em = $this->getDoctrine()->getManager();
			$relaisId=$this->getUser()->getRelais()->getId();

			$lineorder=new OrderLine();
			$lineorder->setQuantity($quantity);
			$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($id);
			$lineorder->setProduct($product);
			$lineorder->setPrix($product->getPrix());
			
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


			$response = new JsonResponse(array('response'=>true,'paniercount'=>count($listOrderLine))
				);
			return $response ;

		}
		public function deleteProductsAction($id,Request $request){
			$session = $request->getSession();
			$em = $this->getDoctrine()->getManager();
			$product= $em->getRepository('CoreCoreBundle:Product')->findOneById($id);
			$listOrderLine=$session->get('panier');
			foreach ($listOrderLine as $key => $value) {
				
					
						if($value->getProduct()->getId() == $product->getId())
						{
							unset($listOrderLine[$key]);
						}

				}
			
			$total=$this->container->get('panier')->total($listOrderLine);


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