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
    
        return $this->render('AdminAdminBundle:Default:login.html.twig');
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
