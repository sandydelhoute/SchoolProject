<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Vendor\ConnectUsersBundle\Entity\UsersWeb;
use Vendor\ConnectUsersBundle\Form\RegistrationUsersWebType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Core\CoreBundle\Entity\Coordonates;
use Core\CoreBundle\Entity\PayCardsCompte;
use Core\CoreBundle\Form\PayCardsCompteType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
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
		        ->setFrom($this->container->getParameter('mailer_user'))
		        ->setTo($usersWeb->getEmail())
		        ->setBody(
		          $this->renderView(
		            ':Email:registration.html.twig' /* ,
		            array('order' => $orderclient)*/
		            ),
		        'text/html'
		        );  
        	$this->get('mailer')->send($message);
      
			return $this->redirectToRoute('loginpage');

		}
	
		return $this->render('CoreCoreBundle:Login:loginlayout.html.twig',array('form' => $form->createView()));
		
	}
    /**
     * @Security("has_role('ROLE_USER')")
     */
	public function compteAction($page,Request $request){
		$em = $this->getDoctrine()->getManager();
		$currentUsers=$this->getUser();
		$listOrder=$em->getRepository('CoreCoreBundle:OrderClient')->historyorder($page,$currentUsers);

		$pagination = array(
            'page' => $page,
            'nbPages' => ceil(count($listOrder) / 10),
            'nomRoute' => 'comptepage',
            'paramsRoute' => array()
        );
        $payCardsCompte= new PayCardsCompte();
        $form = $this->createForm(PayCardsCompteType::class,$payCardsCompte);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
        $currentUsers = $this->getUser();
        $currentUsers->setCashBalance($payCardsCompte->getSolde());
        $em->merge($currentUsers);
        $em->flush();
			return $this->render('CoreCoreBundle:Compte:comptelayout.html.twig',array('listOrder'=>$listOrder,'pagination'=>$pagination,'form'=>$form->createView()));
        }
		return $this->render('CoreCoreBundle:Compte:comptelayout.html.twig',array('listOrder'=>$listOrder,'pagination'=>$pagination,'form'=>$form->createView()));
	}
	
	
	public function addressModifyAction($address,$longitude,$latitude){

		$em = $this->getDoctrine()->getManager();
		$currentUsers=$this->getUser();
		$coordonates = new Coordonates();
		$coordonates->setLongitude($longitude);
		$coordonates->setLatitude($latitude);
		$coordonates->setAddress($address);
		$currentUsers->setAddress($coordonates);
		$em->persist($coordonates);
		$em->persist($currentUsers);
		$em->flush();
		$response = new JsonResponse(
	      array('response'=>true)
	      );
   		return $response ;

	}

}