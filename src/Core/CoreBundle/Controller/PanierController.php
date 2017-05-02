<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Core\CoreBundle\Entity\OrderLine;

class PanierController extends Controller
{
     public function commandeAction()
    {

        return $this->render('CoreCoreBundle:Commande:commandelayout.html.twig');
    }
     public function panierAction(Request $request)
    {

        $session = $request->getSession();
        $listOrderLine=$session->get('panier');
        return $this->render('CoreCoreBundle:Commande:panierlayout.html.twig',array('listOrderLine'=>$listOrderLine));
    }
    public function addProductsAction($id,$quantity,Request $request)
{
  $session = $request->getSession();
  $em = $this->getDoctrine()->getManager();
  $product= $em->getRepository('CoreCoreBundle:Product')->findOneById($id);
  $lineorder=new OrderLine();
  $lineorder->setQuantity($quantity);
  $lineorder->setProduct($product);
  $lineorder->setPrixEntier($product->getPrixEntier());
  $lineorder->setPrixCentime($product->getPrixCentime());

  $listOrderLine=$session->get('panier');
  if($listOrderLine != null)
  { 

$productexit=true;
 foreach ($listOrderLine as $key => $value) {
        if($value->getProduct()->getName() == $lineorder->getProduct()->getName())
        {
          $value->setQuantity($value->getQuantity()+$quantity);
          $session->set('panier',$listOrderLine);
          $productexit=false;
          break;
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

  
  $response = new JsonResponse(
    array('response'=>true)
    );
  return $response ;

}
}
