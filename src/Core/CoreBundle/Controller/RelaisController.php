<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class RelaisController extends Controller
{


    public function IndexAction(){  
   $em = $this->getDoctrine()->getManager();
   //$posts = $em->getRepository('CoreCoreBundle:Posts')
   //->findOneById($id);
    $breadcrumbs = $this->get("white_october_breadcrumbs");
    $breadcrumbs->addItem("Relais", $this->get("router")->generate("actualitypage"));
    $breadcrumbs->prependRouteItem("Accueil", "homepage");
    return $this->render('CoreCoreBundle:Relais:relaislayout.html.twig');

   }
   public function allAction(){
		$em = $this->getDoctrine()->getManager();
		$listRelais = $em->getRepository('CoreCoreBundle:Relais')
		->findAll();
		$serializer = $this->get('jms_serializer');
		$listRelaisSerialize=$serializer->serialize($listRelais,'json');
		$response = new JsonResponse(
			array('data'=>$listRelaisSerialize)
			);
		return $response ;
   }

}