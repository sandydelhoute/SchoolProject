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

return $this->render('AdminAdminBundle:Default:accueil.html.twig',$user);
    }
    else
        return $this->render('AdminAdminBundle:Default:login.html.twig', array('form' => $form->createView()));
    }


 	public function usersAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig',$users);
    } 


    public function productAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig',$product);
    }

    public function menuAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig');
    }
    public function vehiculeAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig');
    }

 public function relaisAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig',array('relais'=>true));
    }



}
