<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\UsersEmployee;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SelectType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UsersEmployeeController extends Controller
{


    public function indexAction(Request $request,$page)
    {
    
     //$nbArticlesParPage = $this->container->getParameter('front_nb_articles_par_page');

$nbArticlesParPage=6;

        $em = $this->getDoctrine()->getManager();

        $listusersemployee = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
            ->findAllPagineEtTrie($page, $nbArticlesParPage);

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
      
/*	return $this->render('AdminAdminBundle:UsersEmployee:listusersemployee.html.twig',array('page'=>$page));*/
    }


	public function addUsersAction(Request $request)
    {
            $usersEmployee = new usersemployee();
            $form = $this->createFormBuilder($usersEmployee)
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),  ))
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
    $em = $this->getDoctrine()->getManager();
    $usersexist=$em->getRepository('VendorConnectUsersBundle:UsersEmployee')
    ->findOneByEmail($usersemployee->getEmail());
    if(is_null($usersexist))
    {
     $password = $this->get('security.password_encoder')
                ->encodePassword($usersEmployee,$usersEmployee->getPlainPassword());
    $usersEmployee->setPassword($password);
    $em->persist($usersEmployee);
    $em->flush();
    $this->addFlash('registred', 'Oui oui, ilest bien enregistrée !');
    /*$message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('admin@mealandbox.fr')
        ->setTo($usersemployee->getEmail())
        ->setBody(
            $this->renderView(
                // app/Resources/views/Emails/registration.html.twig
                'Emails/registration.html.twig',
                array('name' => $name)
            ),
            'text/html'
        );
    $this->get('mailer')->send($message);*/
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
        $usersemployee = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
            ->findOneByEmail($email);
             $form = $this->createFormBuilder($usersemployee)
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
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
    $em = $this->getDoctrine()->getManager();
    $em->persist($usersemployee);
    $em->flush();
    $this->addFlash('registred', 'Oui oui, ilest bien enregistrée !');
   return $this->redirectToRoute('admin_utilisateurs_edit',array('email'=>$usersemployee->getEmail()));

    }
      
        return $this->render('AdminAdminBundle:UsersEmployee:formusersemployee.html.twig',array('form' => $form->createView()));
    }

  public function deleteUsersAction($email)
    {
         $em = $this->getDoctrine()->getManager();
        $usersemployee = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
            ->findOneByEmail($email);
        $em->remove($usersemployee);
        $em->flush();
        $this->addFlash('delete', 'utilisateurs bien surpprimé !');
        return $this->redirectToRoute('admin_utilisateurs',array('page'=>1));

          
    }

}
