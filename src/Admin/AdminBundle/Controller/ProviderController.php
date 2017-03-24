<?php
namespace Admin\AdminBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBundle\Entity\Fournisseurs;
use Core\CoreBundle\Form\FournisseursType;

class ProviderController extends Controller
{


 public function indexAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig',array('relais'=>true));
    }



    public function addProviderAction(Request $request){
    
    $fournisseurs = new Fournisseurs();
    $formaddfournisseurs = $this->createForm(FournisseursType::class,$fournisseurs);
    $formaddfournisseurs->handleRequest($request);

    if ($formaddfournisseurs->isSubmitted() && $formaddfournisseurs->isValid()) {

    $em = $this->getDoctrine()->getManager();
    $fournisseursexist=$em->getRepository('CoreCoreBundle:Fournisseurs')
    ->findOneByName($fournisseurs->getName());
    if(is_null($fournisseursexist))
    {
    $em->persist($fournisseurs);
    $em->flush();
     $this->addFlash('registred', 'Le fournisseur est bien enregistrée !');
     }
     else
     {
     $this->addFlash('error', 'le nom existe déja');   
    }
    return $this->redirectToRoute('admin_fournisseurs_add');

    }
    return $this->render('AdminAdminBundle:Fournisseurs:formfournisseurslayout.html.twig',array('formaddfournisseurs'=>$formaddfournisseurs->createView()));
	}
}