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

    $url = $this->container->get('router')->generate(
    'homepage'/*,
    array('slug' => 'homepage')*/
    );
   

    $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('s.delhoute@sfr.fr')
        ->setTo('s.delhoute@sfr.fr')
        ->setBody(
          $this->renderView(
            ':Email:resetpassword.html.twig',
            array('email' => "toto",'name' => "totos",'action_url'=>"tot",'operating_system'=>"mealandbox",'browser_name'=>"tttt",'support_url'=>$url)
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

  public function inscriptionAction(Request $request)
  {
        $usersWeb = new UsersWeb();
        $form = $this->createForm(RegistrationUsersWebType::class,$usersWeb);
     
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $this->get('security.password_encoder')
                ->encodePassword($usersWeb,$usersWeb->getPlainPassword());
            $usersWeb->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($usersWeb);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }
    
        return $this->render(
            'VendorConnectUsersBundle:Default:inscription2.html.twig',
            array('form' => $form->createView())
       );
     }
}
