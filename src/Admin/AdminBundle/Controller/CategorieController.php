<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Core\CoreBundle\Entity\Categorie;
use Core\CoreBundle\Form\CategorieType;

class CategorieController extends Controller
{

public function indexAction(Request $request,$page,$filter=null)
{
//$nbArticlesParPage = $this->container->getParameter('front_nb_articles_par_page');

        $nbArticlesParPage=10;

        $em = $this->getDoctrine()->getManager();

        $listCategorie = $em->getRepository('CoreCoreBundle:Categorie')
            ->findAllPagineEtTrie($page, $nbArticlesParPage,$filter);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($listCategorie) / $nbArticlesParPage),
            'nomRoute' => 'admin_utilisateurs',
            'paramsRoute' => array()
        );

         $contenu=array(         
            'listCategorie' => $listCategorie,
            'pagination' => $pagination
        );

        return $this->render('AdminAdminBundle:Categorie:listcategorie.html.twig',array('listCategorie'=>$contenu['listCategorie'],'pagination'=>$contenu['pagination']));
      
}
public function addCategorieAction(Request $request)
{
	$categorie = new Categorie();
    $form = $this->createForm(CategorieType::class,$categorie);

   
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid())
    {

	    $em = $this->getDoctrine()->getManager();
	    $categorieExist=$em->getRepository('CoreCoreBundle:Categorie')
	    ->findOneByName($catgorie->getName());
	    if(is_null($categorieExist))
	    {
	    $em->persist($catgorie);
	    $em->flush();
	     $this->addFlash('registred', 'Oui oui, ilest bien enregistrée !');
	     }
	     else
	     {
	     $this->addFlash('error', 'le nom existe déja');   
	    }
	    return $this->redirectToRoute('admin_produits_add');

    }

        return $this->render('AdminAdminBundle:Categorie:formcategorie.html.twig',array('form' => $form->createView()));
	}
}