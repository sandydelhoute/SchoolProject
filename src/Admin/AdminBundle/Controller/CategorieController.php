<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SelectType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Vendor\ConnectUsersBundle\Entity\UsersEmployee;
use Vendor\ConnectUsersBundle\Form\UsersEmployeeType;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

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

}