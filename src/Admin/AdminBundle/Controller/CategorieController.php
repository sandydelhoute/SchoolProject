<?php

namespace Admin\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Util\SecureRandom;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Core\CoreBundle\Entity\Categorie;
use Core\CoreBundle\Form\CategorieType;

class CategorieController extends Controller
{

	public function indexAction(Request $request)
	{
		return $this->render('AdminAdminBundle:Categorie:listcategorie.html.twig');
	}


	public function addCategorieAction(Request $request)
	{

    //$plainPassword = random_bytes(10);
		$categorie = new Categorie();

		/* On crée le FormBuilder grâce au service form factory */
		$form = $this->createForm(CategorieType::class,$categorie);
		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$categoriesexist=$em->getRepository('CoreCoreBundle:Categorie')
			->findOneByName($categorie->getName());
			if(is_null($categoriesexist))
			{
			
				$em->persist($categorie);
				$em->flush();
				$this->addFlash('registred', 'Categorie est bien enregistrée !');
			}
			else
			{
				$this->addFlash('error', 'Email existe déja');   
			}

			return $this->redirectToRoute('admin_categorie_add');

		}

		return $this->render('AdminAdminBundle:Categorie:formcategorielayout.html.twig',array('form' => $form->createView()));
	}




	public function editUsersAction(Request $request,$id)
	{
		$em = $this->getDoctrine()->getManager();
		$categorie = $em->getRepository('VendorConnectUsersBundle:Categorie')
		->findOneById($id);
		$form = $this->createFormBuilder($categorie)
		->add('save', SubmitType::class, array('label' => 'Save'))
		->getForm();

		$form->handleRequest($request);


		if ($form->isSubmitted() && $form->isValid()) {
			$em->persist($usersEmployee);
			$em->flush();

			$this->addFlash('registred', 'Oui oui, il est bien enregistrée !');
			return $this->redirectToRoute('admin_categorie_edit',array('email'=>$usersEmployee->getEmail()));

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
		return $this->redirectToRoute('admin_categorie',array('page'=>1));


	}
}