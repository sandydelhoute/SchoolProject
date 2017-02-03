<?php



namespace Vendor\ConnectUsersBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\Users;
use Vendor\ConnectUsersBundle\Entity\UsersEmployee;
use Vendor\ConnectUsersBundle\Entity\UsersWeb;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;


class UsersEmployeeController extends Controller
{
  public function listUsersEmployeeAction($page){

     //$nbArticlesParPage = $this->container->getParameter('front_nb_articles_par_page');

$nbArticlesParPage=6;

        $em = $this->getDoctrine()->getManager();

        $listusersemployee = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
            ->findAllPagineEtTrie($page, $nbArticlesParPage);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($listusersemployee) / $nbArticlesParPage),
            'nomRoute' => 'admin_utilisateurs',
            'paramsRoute' => array()
        );

         $contenu=array(         
            'listusersemployee' => $listusersemployee,
            'pagination' => $pagination
        );

        return $this->render('VendorConnectUsersBundle:Default:listemployee.html.twig',array('listusersemployee'=>$contenu['listusersemployee'],'pagination'=>$contenu['pagination']));
      
    }

    public function addUsersEmployeeAction(){

    $usersemployee = new usersemployee();
     $form = $this->createFormBuilder($usersemployee)
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('birthdate', DateType::class)
            ->add('status', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();


        return $this->render('VendorConnectUsersBundle:Default:addemployee.html.twig',array('form' => $form->createView()));
      
    }

}