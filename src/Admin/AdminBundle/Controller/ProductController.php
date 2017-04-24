<?php

namespace Admin\AdminBundle\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBundle\Entity\Product;
use Core\CoreBundle\Form\ProductType;

class ProductController extends Controller
{
    public function indexAction(Request $request)
    { 
        return $this->render('AdminAdminBundle:Product:listproduct.html.twig');
    }
       
    public function addProductAction(Request $request){
    
    $product = new Product();
    $form = $this->createForm(ProductType::class,$product);

   
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {

     $em = $this->getDoctrine()->getManager();
    $productexist=$em->getRepository('CoreCoreBundle:Product')
    ->findOneByName($product->getName());
    if(is_null($productexist))
    {
    $fs = new Filesystem();
    $dirProductParent=$this->getParameter('img_product_directory');
    $dirProduct=$dirProductParent.'/'.$product->getName();
    if(!$fs->exists($dirProductParent))
    $fs->mkdir($dirProductParent);
    if(!$fs->exists($dirProduct))
    $fs->mkdir($dirProduct);
    //$file= $form['file'];
    foreach ($product->getImages() as $key=>$image) {
        var_dump($image);
    $image->file->move($dirProduct,$value->getName().$form['file']->guessExtension());
    $image->setPath($dirProduct);
    }
    $em->persist($product);
    $em->flush();
     $this->addFlash('registred', 'Oui oui, ilest bien enregistrée !');
     }
     else
     {
     $this->addFlash('error', 'le nom existe déja');   
    }
    return $this->redirectToRoute('admin_produits_add');

    }

        return $this->render('AdminAdminBundle:Product:formproductlayout.html.twig',array('form' => $form->createView()));
    }


}