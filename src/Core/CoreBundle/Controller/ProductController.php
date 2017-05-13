<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
class ProductController extends Controller
{

  public function productsAction()
  {
   $breadcrumbs = $this->get("white_october_breadcrumbs");
   $breadcrumbs->addItem("Nos produits");
   $breadcrumbs->prependRouteItem("Accueil", "homepage");   
   $em = $this->getDoctrine()->getManager();
   $listAllergene= $em->getRepository('CoreCoreBundle:Allergene')->findAll();
   $listCategorie= $em->getRepository('CoreCoreBundle:Categorie')->findAll();

   return $this->render('CoreCoreBundle:Products:productslayout.html.twig',array('listAllergene'=>$listAllergene,'listCategorie'=>$listCategorie));

 }
 public function productsFilterAction($allergene=null,$categorie,$priceMin,$priceMax,$offsetMin,$offsetMax)
 {
   $em = $this->getDoctrine()->getManager();
   $categorie=explode(",", $categorie);
   $allergene=explode(",", $allergene);

   $listProduct = $em->getRepository('CoreCoreBundle:Product')
   ->filterProduct($categorie,$allergene,$priceMin,$priceMax,$offsetMin,$offsetMax);
       
  $serializer = $this->get('jms_serializer');
  $seri=$serializer->serialize($listProduct,'json');
   $response = new JsonResponse(
    array('data'=>$seri)
    );
   return $response ;

 }


 public function productsDetailAction($id)
 {

  $em = $this->getDoctrine()->getManager();
  $product= $em->getRepository('CoreCoreBundle:Product')->findOneById($id);
  $breadcrumbs = $this->get("white_october_breadcrumbs");
  $breadcrumbs->addItem("Nos Produits", $this->get("router")->generate("productpage"));
  $breadcrumbs->addItem($product->getName());
  $breadcrumbs->prependRouteItem("Accueil", "homepage");   
  return $this->render('CoreCoreBundle:Products:productsdetaillayout.html.twig',array('product'=>$product));
}



}
