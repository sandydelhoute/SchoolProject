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

public function indexAction(Request $request,$page,$filter=null)
{
//$nbArticlesParPage = $this->container->getParameter('front_nb_articles_par_page');

        $nbArticlesParPage=10;

        $em = $this->getDoctrine()->getManager();

        $listAllergene = $em->getRepository('CoreCoreBundle:Allergene')
            ->findAllPagineEtTrie($page, $nbArticlesParPage,$filter);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($listCategorie) / $nbArticlesParPage),
            'nomRoute' => 'admin_utilisateurs',
            'paramsRoute' => array()
        );

         $contenu=array(         
            'listCategorie' => $listAllergene,
            'pagination' => $pagination
        );

        return $this->render('AdminAdminBundle:Allergene:listallergene.html.twig',array('listAllergene'=>$contenu['listAllergene'],'pagination'=>$contenu['pagination']));
      
}
public function addAllergeneAction(Request $request)
{
	$allergene = new Allergene();
    $form = $this->createForm(AllergeneType::class,$allergene);

   
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {

	    $em = $this->getDoctrine()->getManager();
	    $allergeneExist=$em->getRepository('CoreCoreBundle:Categorie')
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

        return $this->render('AdminAdminBundle:Allergene:formallergene.html.twig',array('form' => $form->createView()));
	}
}