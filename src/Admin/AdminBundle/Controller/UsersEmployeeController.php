<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\Users;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UsersEmployeeController extends Controller
{


    public function indexAction(Request $request,$page)
    {
    
	return $this->render('AdminAdminBundle:UsersEmployee:listusersemployee.html.twig',array('page'=>$page));
    }


public function addUsersAction()
    {
		return $this->render('AdminAdminBundle:UsersEmployee:addusersemployee.html.twig');
    } 


}
