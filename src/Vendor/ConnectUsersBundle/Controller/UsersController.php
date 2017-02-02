<?php



namespace Vendor\ConnectUsersBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\Users;
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
    public function connexionAction(Request $request)
    {

$authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('VendorConnectUsersBundle:Default:connectold.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
}


     public function inscriptionAction()
    {
        return $this->render('VendorConnectUsersBundle:Default:inscription.html.twig');

    }
    
}
