<?php

namespace Admin\AdminBundle\Controller;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBundle\Entity\Product;
use Core\CoreBundle\Form\ProductType;
use JMS\Serializer\SerializationContext;
use Symfony\Component\HttpFoundation\JsonResponse;



class ProductController extends Controller
{

    public function indexAction(Request $request)
    { 
        return $this->render('AdminAdminBundle:Product:listproduct.html.twig');
    }



    public function editProductAction(Request $request){



        
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

                foreach ($product->getImages() as $image) {
                    $image->setPath('img/product/'.$product->getName().'/'.$image->getFile()->getClientOriginalName());
                    $image->getFile()->move($dirProduct,$image->getFile()->getClientOriginalName());

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
   public function filterAction($page,$maxPage,$order,$orderSelect,$champ = null)
   {

       $em = $this->getDoctrine()->getManager();

       $repositoryUsers = $em->getRepository('CoreCoreBundle:Product');
       switch ($orderSelect) {
          case 'Name':
          $paginatorResult=$repositoryUsers->findTableControlName($page,$maxPage,$order,$champ);
          break;

          case 'allergene':
          $paginatorResult=$repositoryUsers->findTableControlEmail($page,$maxPage,$order,$champ);
          break;

          case 'Last name':
          $paginatorResult=$repositoryUsers->findTableControlName($page,$maxPage,$order,$champ);
          break;

          case 'status':
          $paginatorResult=$repositoryUsers->findTableControlStatus($page,$maxPage,$order,$champ);
          break;

          default:
          $paginatorResult=$repositoryUsers->findTableControlName($page,$maxPage,$order,$champ);
          break;
      }  

      $pagination = array(
        'page' => $page,
        'nbPages' => ceil(count($paginatorResult) / $maxPage),
        'nomRoute' => 'admin_utilisateurs_filter',
        'paramsRoute' => array()
        );
      $serializer = $this->get('serializer');
      $json = $serializer->serialize(
        $paginatorResult->getIterator()->getArrayCopy(),'json',SerializationContext::create()->setGroups(array('product')));

      $response = new JsonResponse(
          array('data'=>$json,'page'=>$page,'maxPage'=>$maxPage,'nbPage'=>ceil(count($paginatorResult)/$maxPage),'champ'=>$champ,'order'=>$order)
          );
      return $response ;

  }


}