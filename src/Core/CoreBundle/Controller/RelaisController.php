<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializationContext;

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
		$listRelaisSerialize=$serializer->serialize($listRelais,'json',SerializationContext::create()->setGroups(array('relais')));
		$response = new JsonResponse(
			array($listRelaisSerialize)
			);
		return $response ;
   }
   public function selectrelaisAction($id){
    $em = $this->getDoctrine()->getManager();
    $relais = $em->getRepository('CoreCoreBundle:Relais')
    ->findOneById($id);
    if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {

    return $this->redirectToRoute('homepage');
    //return $this->redirectToRoute('blog_show', array('slug' => 'my-page'));
    }
    $this->getUser()->setRelais($relais);
    $em->persist($this->getUser());
    $em->flush();
    $response = new JsonResponse(array('response'=>true,'relaisName'=>$relais->getName()));
    return $response ;
   }

}