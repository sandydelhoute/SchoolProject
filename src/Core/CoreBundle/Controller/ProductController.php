<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use JMS\Serializer\SerializationContext;


class ProductController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     */
  public function productsAction()
  {
    if($this->getUser()->getRelais() == null )
    {
          return $this->redirectToRoute('relaispage');
    }
   $breadcrumbs = $this->get("white_october_breadcrumbs");
   $breadcrumbs->addItem("Nos produits");
   $breadcrumbs->prependRouteItem("Accueil", "homepage");   
   $em = $this->getDoctrine()->getManager();
   $listAllergene= $em->getRepository('CoreCoreBundle:Allergene')->findAll();
   $listCategorie= $em->getRepository('CoreCoreBundle:Categorie')->findAll();

   return $this->render('CoreCoreBundle:Products:productslayout.html.twig',array('listAllergene'=>$listAllergene,'listCategorie'=>$listCategorie));

 }
 public function productsFilterAction($type,$allergene=null,$categorie,$priceMin,$priceMax,$offsetMin,$offsetMax)
 {

  $em = $this->getDoctrine()->getManager();
  $categorie=explode(",", $categorie);
  $allergene=explode(",", $allergene);
  $serializer = $this->get('jms_serializer');
  if($type === 'product')
  {
 
    $listProduct = $em->getRepository('CoreCoreBundle:Product')
    ->filter($categorie,$allergene,$priceMin,$priceMax,$offsetMin,$offsetMax,$this->getUser()->getRelais());

    $listProductSerialize=$serializer->serialize($listProduct,'json', SerializationContext::create()->setGroups(array('product')));
    $response = new JsonResponse(
      array('data'=>$listProductSerialize)
      );
  }
  else
  {
    $listMenu = $em->getRepository('CoreCoreBundle:Menu')
    ->filter($categorie,$allergene,$priceMin,$priceMax,$offsetMin,$offsetMax,$this->getUser()->getRelais());
    //, SerializationContext::create()->setGroups(array('menu'))
    $listMenuSerialize=$serializer->serialize($listMenu,'json');
    $response = new JsonResponse(
      array('data'=>$listMenuSerialize)
      );

  }   
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
