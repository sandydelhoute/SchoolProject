<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\Users;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class CoreController extends Controller
{


    public function indexAction(Request $request)
    {
        $session=$request->getSession();
        $users=new Users();
        $form = $this->createFormBuilder($users)
            ->add('email', TextType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

    $form->handleRequest($request);  
    if ($form->isSubmitted()) {



$em=$this->getDoctrine()->getManager()->getRepository('VendorConnectUsersBundle:Users');
//$arrayusers=$em->findOneby($users);

$arrayusers=array("a" => "orange", "b" => "banana", "c" => "apple");
return $this->render('AdminAdminBundle:Default:accueil.html.twig',array('users'=>true,'arrayusers'=>$arrayusers));
    }
    else
    {
        return $this->render('AdminAdminBundle:Default:login.html.twig', array('form' => $form->createView()));
    }
    }


 	public function usersAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig',array('users'=>true));
    } 


    public function productAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig',array('users'=>true));
    }

    public function menuAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig',array('users'=>true));
    }
    public function vehiculeAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig',array('users'=>true));
    }

 public function relaisAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig',array('relais'=>true));
    }



}
