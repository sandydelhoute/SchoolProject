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

    public function indexAction(Request $request) {
            return $this->render('AdminAdminBundle:Default:accueil.html.twig');

    }
       public function compteAction(Request $request)
    { 
        return $this->render('AdminAdminBundle:Compte:comptelayout.html.twig');
    }
    public function loginAction(){

             return $this->render('AdminAdminBundle:Compte:loginlayout.html.twig');
    }
}
