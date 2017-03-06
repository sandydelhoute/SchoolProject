<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\UsersEmployee;
use Vendor\ConnectUsersBundle\Form\UsersEmployeeType;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;

class UsersEmployeeController extends Controller
{


   /* public function indexAction(Request $request,$page,$filter = null)
    {
    
     //$nbArticlesParPage = $this->container->getParameter('front_nb_articles_par_page');

        $nbArticlesParPage=10;

        $em = $this->getDoctrine()->getManager();

        $listusersemployee = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
            ->findAllPagineEtTrie($page, $nbArticlesParPage,$filter);

        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($listusersemployee) / $nbArticlesParPage),
            'nomRoute' => 'admin_utilisateurs',
            'paramsRoute' => array()
        );

         $contenu=array(         
            'listusersemployee' => $listusersemployee,
            'pagination' => $pagination
        );

        return $this->render('AdminAdminBundle:UsersEmployee:listusersemployee.html.twig',array('listusersemployee'=>$contenu['listusersemployee'],'pagination'=>$contenu['pagination']));
      

    }*/


     public function indexAction(Request $request)
    { 
        return $this->render('AdminAdminBundle:UsersEmployee:listusersemployee2.html.twig');
    }



    public function filterAction($page,$filter = null)
    {
    

     //$nbArticlesParPage = $this->container->getParameter('front_nb_articles_par_page');

        $nbArticlesParPage=10;

        $em = $this->getDoctrine()->getManager();

      $listusersemployee = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
            ->findAll();
      $serializer = $this->get('serializer');
     $serializedUsers = array();
        foreach ($listusersemployee as $user) {
        $serializedUsers[] = $serializer->normalize($user, 'json');
    }
        $pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($listusersemployee) / $nbArticlesParPage),
        );

         $contenu=array(         
            'listusersemployee' => $listusersemployee,
            'pagination' => $pagination
        );
      /*  $serializer = $this->get('serializer');
        $json = $serializer->serialize(
            $listusersemployee,
            'json'
        );*/

        $response = new JsonResponse(array(
       'data' => $serializedUsers
    ));

        return     $response ;
    }






    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
	public function addUsersAction(Request $request)
    {

    //$plainPassword = random_bytes(10);
    $usersEmployee = new usersemployee();

    /* On crée le FormBuilder grâce au service form factory */
    $form = $this->createForm(UsersEmployeeType::class,$usersEmployee);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $em = $this->getDoctrine()->getManager();
    $usersexist=$em->getRepository('VendorConnectUsersBundle:UsersEmployee')
    ->findOneByEmail($usersEmployee->getEmail());
    if(is_null($usersexist))
    {
    $password = $this->get('security.password_encoder')
                ->encodePassword($usersEmployee,$usersEmployee->getPlainPassword());
    $usersEmployee->setPassword($password);
    $em->persist($usersEmployee);
    $em->flush();
    $this->addFlash('registred', 'Oui oui, ilest bien enregistrée !');
    $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('mealandbox@gmail.com')
        ->setTo('s.delhoute@sfr.fr')
        //->setTo($usersemployee->getEmail())
        ->setBody(
            $this->renderView(
                 ':Email:registration.html.twig'
                // 'Emails/registration.html.twig',
                // array('name' => "guillaume")
                 ),
            'text/html'
        );
    $this->get('mailer')->send($message);
    }
    else
    {
    $this->addFlash('error', 'Email existe déja');   
    }

    return $this->redirectToRoute('admin_utilisateurs_add');

    }

        return $this->render('AdminAdminBundle:UsersEmployee:formusersemployee.html.twig',array('form' => $form->createView()));
    }




    public function editUsersAction(Request $request,$email)
    {
		$em = $this->getDoctrine()->getManager();
        $usersEmployee = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
        ->findOneByEmail($email);
        $form = $this->createFormBuilder($usersEmployee)
            ->remove('password')
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
           
            ->add('plainPassword',PasswordType::class, 
                array('label' => 'Password','attr'=>array('placeholder' => '*******'),'disabled' => 'disabled'))
            ->add('birthdate', DateType::class)
            ->add('numbersocial', TextType::class)   
            ->add('status',EntityType::class, array(
                        'class'    => 'VendorConnectUsersBundle:Status',
                        'choice_label' => 'name',
                        ))
            ->add('save', SubmitType::class, array('label' => 'Save'))
            ->getForm();

        $form->handleRequest($request);


    if ($form->isSubmitted() && $form->isValid()) {
    $em->persist($usersEmployee);
    $em->flush();

    $this->addFlash('registred', 'Oui oui, ilest bien enregistrée !');
   return $this->redirectToRoute('admin_utilisateurs_edit',array('email'=>$usersEmployee->getEmail()));

    }
       
        return $this->render('AdminAdminBundle:UsersEmployee:formusersemployee.html.twig',array('form' => $form->createView()));
    }

  public function deleteUsersAction($email)
    {
         $em = $this->getDoctrine()->getManager();
        $usersEmployee = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
            ->findOneByEmail($email);
        $em->remove($usersEmployee);
        $em->flush();
        $this->addFlash('delete', 'utilisateurs bien surpprimé !');
        return $this->redirectToRoute('admin_utilisateurs',array('page'=>1));

          
    }

function randomPassword($length,$count, $characters) {
 
// $length - the length of the generated password
// $count - number of passwords to be generated
// $characters - types of characters to be used in the password
 
// define variables used within the function    
    $symbols = array();
    $passwords = array();
    $used_symbols = '';
    $pass = '';
 
// an array of different character types    
    $symbols["lower_case"] = 'abcdefghijklmnopqrstuvwxyz';
    $symbols["upper_case"] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $symbols["numbers"] = '1234567890';
    $symbols["special_symbols"] = '!?~@#-_+<>[]{}';
 
    $characters = split(",",$characters); // get characters types to be used for the passsword
    foreach ($characters as $key=>$value) {
        $used_symbols .= $symbols[$value]; // build a string with all characters
    }
    $symbols_length = strlen($used_symbols) - 1; //strlen starts from 0 so to get number of characters deduct 1
     
    for ($p = 0; $p < $count; $p++) {
        $pass = '';
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $symbols_length); // get a random character from the string with all characters
            $pass .= $used_symbols[$n]; // add the character to the password string
        }
        $passwords[] = $pass;
    }
     
    return $passwords; // return the generated password
}
 
 
 
}
