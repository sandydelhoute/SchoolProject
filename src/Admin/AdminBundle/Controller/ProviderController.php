<?php
namespace Admin\AdminBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBundle\Entity\Provider;
use Core\CoreBundle\Form\ProviderType;

class ProviderController extends Controller
{


 public function indexAction()
    {
return $this->render('AdminAdminBundle:Default:accueil.html.twig',array('relais'=>true));
    }



    public function addProviderAction(Request $request){
    
    $provider = new Provider();
    $formAddProvider = $this->createForm(ProviderType::class,$provider);
    $formAddProvider->handleRequest($request);

    if ($formAddProvider->isSubmitted() && $formAddProvider->isValid()) {

    $em = $this->getDoctrine()->getManager();
    $providerExist=$em->getRepository('CoreCoreBundle:Provider')
    ->findOneByName($provider->getName());
    if(is_null($providerExist))
    {
    $em->persist($provider);
    $em->flush();
     $this->addFlash('registred', 'Le fournisseur est bien enregistrée !');
     }
     else
     {
     $this->addFlash('error', 'le nom existe déja');   
    }
    return $this->redirectToRoute('admin_fournisseurs_add');

    }
    return $this->render('AdminAdminBundle:Provider:formproviderlayout.html.twig',array('formAddProvider'=>$formAddProvider->createView()));
	}
}