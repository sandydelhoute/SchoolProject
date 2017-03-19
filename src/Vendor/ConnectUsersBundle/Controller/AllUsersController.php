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



class AllUsersController extends Controller
{
  
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
