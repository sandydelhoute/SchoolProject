<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class PostsController extends Controller
{


    public function IndexAction()
   {
       return $this->render('CoreCoreBundle:Posts:postslayout.html.twig');

   }
   public function ScrollAction($offsetmin,$offsetmax)
   {
   $em = $this->getDoctrine()->getManager();
   $listPosts = $em->getRepository('CoreCoreBundle:Posts')
   ->scrollPosts($offsetmin,$offsetmax);

   $serializer = $this->get('serializer');
   $json = $serializer->serialize(
    $listPosts,
    'json'
    );

   $response = new JsonResponse(
    array('data'=>$json)
    );
   return $response ;
   }

}