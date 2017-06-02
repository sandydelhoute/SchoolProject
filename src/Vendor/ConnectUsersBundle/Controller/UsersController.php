<?php

namespace Vendor\ConnectUsersBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\UsersEmployee;
use Vendor\ConnectUsersBundle\Entity\UsersWeb;
use \DateTime;
use \DateInterval;
use Vendor\ConnectUsersBundle\Form\RegistrationUsersWebType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class UsersController extends Controller
{

  public function requestResetPasswordAction($email){

    $em = $this->getDoctrine()->getManager();
    $usersexist = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')->findOneByEmail($email);
    if(is_null($usersexist))
    {
       $usersexist = $em->getRepository('VendorConnectUsersBundle:UsersWeb')->findOneByEmail($email);  
   }

   if(!is_null($usersexist))
   { 
    $token= hash("sha512", uniqid());
    $limiteDate=new DateTime();
    $limiteDate->add(new DateInterval('P1D'));
    $usersexist->setTokenResetPass($token);
    $usersexist->setLimiteDateResetPass($limiteDate);

    $contact = $this->container->get('router')->generate(
    'contactpage'/*,
    array('slug' => 'homepage')*/
    );
   
    $urlpassword = $this->container->get('router')->generate(
    'resetpasswordpage',
    array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL
    );

    $message = \Swift_Message::newInstance()
        ->setSubject('Demande reinitialisation password')
        ->setFrom($container->getParameter('mailer.user'))
        ->setTo($usersexist->getEmail())
        ->setBody(
          $this->renderView(
            ':Email:resetpassword.html.twig',
            array('email' => "toto",'name' => "totos",'action_url'=>$urlpassword,'operating_system'=>"mealandbox",'browser_name'=>"tttt",'support_url'=>$contact)
            ),
        'text/html'
        );  
    $this->get('mailer')->send($message);
    $em->persist($usersexist);
    $em->flush(); 
    }
    else
    {
        $response = new JsonResponse(array(
           'response' => false
           ));
        return     $response ;
    }

    $response = new JsonResponse(array(
       'response' => true
       ));

    return     $response ;
}
public function resetPasswordAction($token,Request $request){

    $em = $this->getDoctrine()->getManager();
    $usersexist = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')->findOneByTokenResetPass($token);
    if(is_null($usersexist))
    {
        $usersexist = $em->getRepository('VendorConnectUsersBundle:UsersWeb')->findOneByTokenResetPass($token);
    }

   if(!is_null($usersexist))
    {
      if( $usersexist->getLimiteDateResetPass()<new DateTime())
      { 
        if($class==="Vendor\ConnectUsersBundle\Entity\UsersEmployee")
        {
          return $this->redirectToRoute('admin_homepage');
        }
        else
        {
          return $this->redirectToRoute('homepage');
        }
      }
      else
      {
        return $this->redirectToRoute('homepage');
      }
    }
    else
    {
    return $this->redirectToRoute('homepage');
    }

}
      public function connectionAction(Request $request)
    {

        $authenticationUtils = $this->get('security.authentication_utils');
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('VendorConnectUsersBundle:Default:connectionUsersWeb.html.twig', array(

            'last_username' => $lastUsername,
            'error'         => $error,
            ));
    }
}
