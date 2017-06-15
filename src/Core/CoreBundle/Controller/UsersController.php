<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\UsersWeb;
use Vendor\ConnectUsersBundle\Form\RegistrationUsersWebType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UsersController extends Controller
{

	public function loginAction(Request $request)
	{
		$usersWeb = new UsersWeb();
		$form = $this->createForm(RegistrationUsersWebType::class,$usersWeb);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$usersExist=$em->getRepository('VendorConnectUsersBundle:UsersWeb')->findOneByEmail($usersWeb->getEmail());
			if(!is_null($usersExist))
			{
				$this->addFlash('error', 'Email existe déja');
			}
			$password = $this->get('security.password_encoder')
			->encodePassword($usersWeb,$usersWeb->getPlainPassword());
			$usersWeb->setPassword($password);

			$em->persist($usersWeb);
			$em->flush();


			 $message = \Swift_Message::newInstance()
		        ->setSubject('Récapitulatif Inscription Meal & Box')
		        ->setFrom($this->container->getParameter('mailer.user'))
		        ->setTo($this->getUser()->getEmail())
		        ->setBody(
		          $this->renderView(
		            ':Email:confirmcommande.html.twig',
		            array('order' => $orderclient)
		            ),
		        'text/html'
		        );  
        	$this->get('mailer')->send($message);
      
			return $this->redirectToRoute('loginpage');

		}
	
		return $this->render('CoreCoreBundle:Login:loginlayout.html.twig',array('form' => $form->createView()));
		
	}


	public function compteAction(){
		$em = $this->getDoctrine()->getManager();
		$currentUsers=$this->getUser();
		$listOrder=$em->getRepository('CoreCoreBundle:OrderClient')->findByUsers($currentUsers);
		return $this->render('CoreCoreBundle:Compte:comptelayout.html.twig',array('listOrder'=>$listOrder));
	}

}