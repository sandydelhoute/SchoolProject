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
			$password = $this->get('security.password_encoder')
			->encodePassword($usersWeb,$usersWeb->getPlainPassword());
			$usersWeb->setPassword($password);

			$em = $this->getDoctrine()->getManager();
			$em->persist($usersWeb);
			$em->flush();
			// $token = new UsernamePasswordToken($usersWeb, null, 'core', array('ROLE_USER'));
			// $this->get('security.context')->setToken($token);
			$this->addFlash('error', 'Email existe déja');   
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