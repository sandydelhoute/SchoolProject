<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBundle\Entity\Menu;
use Core\CoreBundle\Form\MenuType;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;

class MenuController extends Controller
{


     public function indexAction(Request $request)
    { 
        return $this->render('AdminAdminBundle:Menu:listmenu.html.twig');
    }


    public function orderBYAction($orderby = null)
    {

        $em = $this->getDoctrine()->getManager();

        $listmenu = $em->getRepository('CoreCoreBundle:Menu')
        ->findAll();

        $serializer = $this->get('serializer');
        $json = $serializer->serialize(
            $listmenu,
            'json'
            );

        $response = new JsonResponse(array(
         'data' => $serializedUsers
         ));

        return     $response ;
    }





    public function searchAction($search)
    {
    
        $em = $this->getDoctrine()->getManager();
        $listmenu = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
        ->findAll();
        $serializer = $this->get('serializer');
        $json = $serializer->serialize(
            $listusersemployee,
            'json'
            );
        $response = new JsonResponse(array(
         'data' => $serializedUsers
         ));
        return     $response ;
    }



    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
	public function addMenuAction(Request $request)
    {

    $menu = new Menu();

    /* On crée le FormBuilder grâce au service form factory */
    $form = $this->createForm(MenuType::class,$menu);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $em = $this->getDoctrine()->getManager();
    $menuexist=$em->getRepository('coreCoreBundle:Menu')
    ->findOneByName($menu->getNom());
    if(is_null($menuexist))
    {
    $em->persist($menu);
    $em->flush();
    $this->addFlash('registred', 'Votre menu a bien été enregistré');
    }
    else
    {
    $this->addFlash('error', 'le menu existe déja');   
    }

    return $this->redirectToRoute('admin_menu_add');

    }

        return $this->render('AdminAdminBundle:Menu:formmenulayout.html.twig',array('form' => $form->createView()));
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
