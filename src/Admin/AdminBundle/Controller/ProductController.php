<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\Users;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ProductController extends Controller
{
  public function indexAction(Request $request,$page)
    {
 //$nbArticlesParPage = $this->container->getParameter('front_nb_articles_par_page');

        $nbArticlesParPage=10;

        $em = $this->getDoctrine()->getManager();

     /*   $listProduct = $em->getRepository('CoreCoreBundle:Product')
            ->findAllPagineEtTrie($page, $nbArticlesParPage);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($listProduct) / $nbArticlesParPage),
            'nomRoute' => 'admin_product',
            'paramsRoute' => array()
        );

         $contenu=array(         
            'listproduct' => $listProduct,
            'pagination' => $pagination
        );*/
		$listProduct = $em->getRepository('CoreCoreBundle:Product')
            ->findAll();

         var_dump($listProduct);
         exit;
        return $this->render('AdminAdminBundle:Product:listproduct.html.twig',array('listproduct'=>$contenu['listProduct'],'pagination'=>$contenu['pagination']));
      
 			
    }

}