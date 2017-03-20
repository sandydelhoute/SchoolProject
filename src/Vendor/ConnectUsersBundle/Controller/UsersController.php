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



class UsersController extends Controller
{
    public function indexAction()
    {   

        $user = $this->get('security.context')->getToken()->getUser();
        return $this->render('VendorConnectUsersBundle:Default:compte.html.twig');

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

    public function inscriptionAction(Request $request)
    {
         // 1) build the form
        $usersWeb = new UsersWeb();
        $form = $this->createFormBuilder($usersWeb)
            ->add('email', EmailType::class)
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('termsAccepted', CheckboxType::class, array(
                'mapped' => false,
                /*'constraints' => new IsTrue(),*/
            ))
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        // 2) handle the submit (will only happen on POST)
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
