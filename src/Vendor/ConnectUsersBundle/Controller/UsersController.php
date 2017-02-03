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


class UsersController extends Controller
{
    public function indexAction()
    {   

        $user = $this->get('security.context')->getToken()->getUser();
        return $this->render('VendorConnectUsersBundle:Default:compte.html.twig');

    }
    public function connexionwebAction(Request $request)
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
 public function connexionadminAction(Request $request)
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

     public function inscriptionAction()
    {
        return $this->render('VendorConnectUsersBundle:Default:inscription.html.twig');

    }
    public function resetPasswordAction(){

    $em = $this->getDoctrine()->getManager();
     $entity = $em->getRepository('LizeoUserBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $formFactory = $this->container->get('fos_user.change_password.form.factory');

        $form = $formFactory->createForm();
        $form->remove('current_password');
        $form->setData($entity);

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $userManager = $this->container->get('fos_user.user_manager');
                $userManager->updateUser($entity);

                return $this->redirect($this->generateUrl('admin_user'));
            }
        }

        return array(
            'entity'      => $entity,
            'form'   => $form->createView(),
        );

    }
 
    
}
