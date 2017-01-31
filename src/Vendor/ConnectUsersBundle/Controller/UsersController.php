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


        /*$session=$request->getSession();
        $users=new Users();
        $form = $this->createFormBuilder($users)
            ->add('email', TextType::class)
            ->add('password', PasswordType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

    $form->handleRequest($request);  
    if ($form->isSubmitted()) {
        
            //$users->getData();

            echo "tati";
            // $em=$this->getDoctrine()->getManager()->getRepository('VendorConnectUsersBundle:Users');
            // $usersreturn=$em->findOneByEmail($users);
          

            //            if(!is_null($usersreturn))
            //            {
            //              if($users->getPassword()!= $usersreturn->getPassword())
            //                 {
            //            //return $this->redirectToRoute('homepage');
            //             return $this->render('VendorConnectUsersBundle:Default:inscription.html.twig');

            //                 } 
            //                else
            //                 {

            //             $session->set('users',$usersreturn);
            //             //return $this->redirectToRoute('homepage');
            //             return $this->render('VendorConnectUsersBundle:Default:inscription.html.twig');
            //                }

            //             }
            //             else
            //             {

            //                return $this->render('VendorConnectUsersBundle:Default:connexion.html.twig', array('form' => $form->createView())); 
            //            }

    //return $this->render('VendorConnectUsersBundle:Default:inscription.html.twig');
    return $this->redirectToRoute('homepage');*/



            
       /* }
                // if(!$session->has('users'))
                    //    {
        return $this->render('VendorConnectUsersBundle:Default:connexion.html.twig', array('form' => $form->createView()));
                    // }
                    // else
                    // {

                //return $this->render('VendorConnectUsersBundle:Default:compte.html.twig');
                    //}
              
            


    }*/
    public function deconnexionAction(Request $request)
    {        
            $session = $request->getSession()->remove('users');
            //$users = $session->get('users');
        return $this->redirectToRoute('homepage');


    }
     public function inscriptionAction()
    {
        return $this->render('VendorConnectUsersBundle:Default:inscription.html.twig');

    }
    public function connexionPasswordErrorAction(){
                    return $this->render('VendorConnectUsersBundle:Default:passworderror.html.twig');

    }
    public function connexionCompteErrorAction(){
return $this->render('VendorConnectUsersBundle:Default:compteerror.html.twig');

    }

}
