<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\UsersEmployee;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SelectType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UsersEmployeeController extends Controller
{


    public function indexAction(Request $request,$page)
    {
    
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

        return $this->render('AdminAdminBundle:UsersEmployee:listusersemployee.html.twig',array('listusersemployee'=>$contenu['listusersemployee'],'pagination'=>$contenu['pagination']));
      
/*	return $this->render('AdminAdminBundle:UsersEmployee:listusersemployee.html.twig',array('page'=>$page));*/
    }


	public function addUsersAction(Request $request)
    {
            $usersemployee = new usersemployee();
            $form = $this->createFormBuilder($usersemployee)
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
            ->add('password', TextType::class)
            ->add('birthdate', DateType::class)
            ->add('numbersocial', TextType::class)   
            ->add('status',EntityType::class, array(
                        'class'    => 'VendorConnectUsersBundle:Status',
                        'choice_label' => 'name',
                        ))
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);


    if ($form->isSubmitted() && $form->isValid()) {
    $em = $this->getDoctrine()->getManager();
    $repository=$em->getRepository('VendorConnectUsersBundle:UsersEmployee');
    $repository->findByEmail($usersemployee->getEmail());
    if(!$repository)
    {
    $em->persist($usersemployee);
    $em->flush();
    $this->addFlash('registred', 'Oui oui, ilest bien enregistrée !');
    }
    else
    {
    $this->addFlash('error', 'Email existe déja');   
    }

    return $this->redirectToRoute('admin_utilisateurs_add');

    }

        return $this->render('AdminAdminBundle:UsersEmployee:formusersemployee.html.twig',array('form' => $form->createView()));
    }




    public function editUsersAction(Request $request,$email)
    {
		 $em = $this->getDoctrine()->getManager();
        $usersemployee = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
            ->findOneByEmail($email);
             $form = $this->createFormBuilder($usersemployee)
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
            ->add('birthdate', DateType::class)
            ->add('numbersocial', TextType::class)   
            ->add('status',EntityType::class, array(
                        'class'    => 'VendorConnectUsersBundle:Status',
                        'choice_label' => 'name',
                        ))
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);


    if ($form->isSubmitted() && $form->isValid()) {
    $em = $this->getDoctrine()->getManager();
    $em->persist($usersemployee);
    $em->flush();
    $this->addFlash('registred', 'Oui oui, ilest bien enregistrée !');
   return $this->redirectToRoute('admin_utilisateurs_edit',array('email'=>$usersemployee->getEmail()));

    }
      
        return $this->render('AdminAdminBundle:UsersEmployee:formusersemployee.html.twig',array('form' => $form->createView()));
    }


}
