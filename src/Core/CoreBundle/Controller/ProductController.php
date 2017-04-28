<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
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
}
