<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializationContext;

class PostsController extends Controller
{


    public function IndexAction(){  
    $breadcrumbs = $this->get("white_october_breadcrumbs");
    $breadcrumbs->addItem('Actualités');
    $breadcrumbs->prependRouteItem("Accueil", "homepage");

      return $this->render('CoreCoreBundle:Posts:postslayout.html.twig');

   }
   public function ScrollAction($offsetmin,$offsetmax)
   {

   $em = $this->getDoctrine()->getManager();
   $listPosts = $em->getRepository('CoreCoreBundle:Posts')
   ->scrollPosts($offsetmin,$offsetmax);
 
   $serializer = $this->get('jms_serializer');
   $test="toto";
   $json = $serializer->serialize($listPosts,'json',SerializationContext::create()->setGroups(array('posts')));


   $response = new JsonResponse(
    array('data'=>$json)
    );

 
      return $response ;
   }


   public function detailAction($id){
   $em = $this->getDoctrine()->getManager();
   $posts = $em->getRepository('CoreCoreBundle:Posts')
   ->findOneById($id);
    $breadcrumbs = $this->get("white_october_breadcrumbs");
    $breadcrumbs->addItem("Actualités", $this->get("router")->generate("actualitypage"));
    $breadcrumbs->addItem($posts->getTitle());
    $breadcrumbs->prependRouteItem("Accueil", "homepage");
    return $this->render('CoreCoreBundle:Posts:postsdetaillayout.html.twig',array('posts'=>$posts));

   }

}