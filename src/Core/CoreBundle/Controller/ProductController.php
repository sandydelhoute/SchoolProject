<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Core\CoreBundle\Entity\OrderLine;
class ProductController extends Controller
{

  public function productsAction()
  {
   $em = $this->getDoctrine()->getManager();

   $listAllergene= $em->getRepository('CoreCoreBundle:Allergene')->findAll();
   $listCategorie= $em->getRepository('CoreCoreBundle:Categorie')->findAll();

   return $this->render('CoreCoreBundle:Products:productslayout.html.twig',array('listAllergene'=>$listAllergene,'listCategorie'=>$listCategorie));

 }
 public function productsfilterAction()
 {
   $em = $this->getDoctrine()->getManager();

   $listProduct = $em->getRepository('CoreCoreBundle:Product')
   ->findAll();

   $serializer = $this->get('serializer');
   $json = $serializer->serialize(
    $listProduct,
    'json'
    );

   $response = new JsonResponse(
    array('data'=>$json)
    );
   return $response ;

 }


 public function productsDetailAction($id)
 {
  $em = $this->getDoctrine()->getManager();
  $product= $em->getRepository('CoreCoreBundle:Product')->findOneById($id);

  return $this->render('CoreCoreBundle:Products:productsdetaillayout.html.twig',array('product'=>$product));
}


public function addProductsAction($id,$quantity,Request $request)
{
  $session = $request->getSession();
  $em = $this->getDoctrine()->getManager();
  $product= $em->getRepository('CoreCoreBundle:Product')->findOneById($id);

  $serializer = $this->get('serializer');
  $json = $serializer->serialize(
    $product,
    'json'
    );
  $lineorder=new OrderLine();
  $lineorder->setQuantity($quantity);
  $lineorder->setProduct($product);
  $lineorder->setPrixEntier($product->getPrixEntier());
  $lineorder->setPrixCentime($product->getPrixCentime());

  $listOrderLine=$session->get('panier');
  if($listOrderLine != null)
  {
      array_push($listOrderLine,$lineorder);
      $session->set('panier',$listOrderLine);
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
