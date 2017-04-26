<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Core\CoreBundle\Entity\Allergene;
use Core\CoreBundle\Form\AllergeneType;

class AllergeneController extends Controller
{

public function indexAction(Request $request){
        return $this->render('AdminAdminBundle:Allergene:listallergene.html.twig');
    
}
public function addAllergeneAction(Request $request)
{
	$allergene = new Allergene();
    $form = $this->createForm(AllergeneType::class,$allergene);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {

	    $em = $this->getDoctrine()->getManager();
	    $allergeneExist=$em->getRepository('CoreCoreBundle:Allergene')
	    ->findOneByName($allergene->getName());
	    if(is_null($allergeneExist))
	    {
	    $em->persist($allergene);
	    $em->flush();
	     $this->addFlash('registred', 'Oui oui, ilest bien enregistrée !');
	     }
	     else
	     {
	     $this->addFlash('error', 'le nom existe déja');   
	    }
	    return $this->redirectToRoute('admin_allergene_add');

    }

        return $this->render('AdminAdminBundle:Allergene:formallergenelayout.html.twig',array('form' => $form->createView()));
	}
}