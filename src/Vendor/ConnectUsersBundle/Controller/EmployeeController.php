<?php

namespace Vendor\ConnectUsersBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\Users;
use Vendor\ConnectUsersBundle\Entity\UsersEmployee;
use Vendor\ConnectUsersBundle\Entity\UsersWeb;

class EmployeeController extends Controller
{
  
 public function indexAction(){   
    $user = $this->get('security.token_storage')->getToken()->getUser();
    return $this->render('VendorConnectUsersBundle:Default:compte.html.twig',array('user'=>$user));
}

public function connectionAction(Request $request){
        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('VendorConnectUsersBundle:Default:connectionUsersEmployee.html.twig', array('last_username' => $lastUsername,'error'=>$error));
}

}
