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
use JMS\Serializer\SerializationContext;

class UsersEmployeeController extends Controller
{


public function indexAction(Request $request)
{ 
    return $this->render('AdminAdminBundle:UsersEmployee:listusersemployee.html.twig');
}


public function filterAction($page,$maxPage,$order,$orderSelect,$champ = null)
{

 $em = $this->getDoctrine()->getManager();

  $paginatorResult = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
  ->findTableControl($page,$maxPage,$orderSelect,$order);
  $pagination = array(
    'page' => $page,
    'nbPages' => ceil(count($paginatorResult) / $maxPage),
    'nomRoute' => 'admin_utilisateurs_filter',
    'paramsRoute' => array()
  );
 $serializer = $this->get('serializer');
 $json = $serializer->serialize(
    $paginatorResult->getIterator()->getArrayCopy(),'json',SerializationContext::create()->setGroups(array('userEmployee')));

 $response = new JsonResponse(
      array('data'=>$json,'page'=>$page,'maxPage'=>$maxPage,'nbPage'=>ceil(count($paginatorResult)/$maxPage),'champ'=>$champ,'order'=>$order)
     );
 return $response ;

}

public function addAction(Request $request)
{

    $usersEmployee = new usersemployee();

    // On crée le FormBuilder grâce au service form factory 
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
            $this->addFlash('registred', 'L \' utilisateur est bien enregistrée !');

           $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('mealandbox@gmail.com')
            ->setTo('s.delhoute@sfr.fr')
            //->setTo($usersemployee->getEmail())
            ->setBody(
                $this->renderView(':Email:registration.html.twig'//,array('name' => "guillaume")
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

    return $this->render('AdminAdminBundle:UsersEmployee:formusersemployeelayout.html.twig',array('form' => $form->createView()));
}


public function editAction(Request $request,$email)
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

public function deleteAction($email)
{
   $em = $this->getDoctrine()->getManager();
   $usersEmployee = $em->getRepository('VendorConnectUsersBundle:UsersEmployee')
   ->findOneByEmail($email);
   $em->remove($usersEmployee);
   $em->flush();
   $this->addFlash('delete', 'utilisateurs bien surpprimé !');
   return $this->redirectToRoute('admin_utilisateurs',array('page'=>1));


}


}
