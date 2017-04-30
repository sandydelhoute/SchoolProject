<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBundle\Entity\Contact;
use Core\CoreBundle\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends Controller
{

	public function contactAction(Request $request)
	{


		$contact = new Contact();
		$form = $this->createForm(ContactType::class,$contact);
		$securityContext = $this->container->get('security.authorization_checker');
		if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			$contact->setEmail();
			$contact->setFirstName();
			$contact->setFirstName();
			$form->remove();
		}

    // On crée le FormBuilder grâce au service form factory 
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$this->addFlash('contactok', 'Votre message a bien été transmis,nous reprendrons contact avec vous rapidement.');

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
		
			return $this->render('CoreCoreBundle:Contact:contactlayout.html.twig',array('form'=>$form->createView()));
	


	}
}