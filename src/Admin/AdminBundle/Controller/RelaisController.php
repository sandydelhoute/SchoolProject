<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBundle\Entity\Relais;
use Core\CoreBundle\Entity\Opening;
use Core\CoreBundle\Form\RelaisType;
use Core\CoreBundle\Form\OpeningType;


class RelaisController extends Controller
{


 public function indexAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig',array('relais'=>true));
    }



    public function addRelaisAction(Request $request){
    
    $relais = new Relais();
    $formaddrelais = $this->createForm(RelaisType::class,$relais);
    $formaddrelais->handleRequest($request);

    $opening=new Opening();
    $formaddhoraire = $this->createForm(OpeningType::class,$opening);
    $formaddhoraire->handleRequest($request);

    if ($formaddrelais->isSubmitted() && $formaddrelais->isValid()) {

     $em = $this->getDoctrine()->getManager();
    $relaisexist=$em->getRepository('CoreCoreBundle:Relais')
    ->findOneByName($relais->getName());
    if(is_null($relaisexist))
    {
    $em->persist($relais);
    $em->flush();
     $this->addFlash('registred', 'Oui oui, il est bien enregistrée !');
     }
     else
     {
     $this->addFlash('error', 'le nom existe déja');   
    }
    return $this->redirectToRoute('admin_produits_add');

    }
    return $this->render('AdminAdminBundle:Relais:formrelaislayout.html.twig',array('formaddrelais'=>$formaddrelais->createView(),'formaddhoraire'=>$formaddhoraire->createView()));
	}
}