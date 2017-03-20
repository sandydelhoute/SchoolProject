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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;



class EmployeeController extends Controller
{
    

    
   public function indexAction()
   {   


    $user = $this->get('security.token_storage')->getToken()->getUser();

    return $this->render('VendorConnectUsersBundle:Default:compte.html.twig',array('user'=>$user));

}

public function connectionAction(Request $request)
{

    $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();


    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('VendorConnectUsersBundle:Default:connectionUsersEmployee.html.twig', array(

        'last_username' => $lastUsername,
        'error'         => $error,
        ));
}

public function resetPasswordAction($email){

    $em = $this->getDoctrine()->getManager();
    $users = $em->getRepository('VendorConnectUsersBundle:UsersWeb')->findOneByEmail($email);
        //$token=$this->get('security.context')->getToken();
    $message = \Swift_Message::newInstance()
    ->setSubject('Hello Email')
    ->setFrom('s.delhoute@sfr.fr')
    ->setTo('s.delhoute@sfr.fr')
    ->setBody(
        $this->renderView(
            'VendorConnectUsersBundle:Email:registration.html.twig',
            array('email' => $users->getEmail(),'name' => $users->getName())
            ),
        'text/html'
        );
    $this->get('mailer')->send($message);

    
    return $this->redirectToRoute('homepage');

}


}
