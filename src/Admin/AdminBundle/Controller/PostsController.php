<?php

namespace Admin\AdminBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Core\CoreBundle\Entity\Posts;
use Core\CoreBundle\Form\PostsType;
use Symfony\Component\Filesystem\Filesystem;
use \DateTime;

class PostsController extends Controller
{


	public function	AddPostsAction(Request $request){
	$posts = new Posts();
    $form = $this->createForm(PostsType::class,$posts);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
    $fs = new Filesystem();
    $dirPostsParent=$this->getParameter('img_posts_directory');
    $dateNow=new DateTime();
    $dirPosts=$dirPostsParent.'/'.$dateNow->format('Y-m-d').'/'.$posts->getTitle();
    if(!$fs->exists($dirPostsParent))
    $fs->mkdir($dirPostsParent);
    if(!$fs->exists($dirPosts))
    $fs->mkdir($dirPosts);

    foreach ($posts->getImages() as $image) {
    $image->setPath('img/product/'.$dateNow->format('Y-m-d').'/'.$posts->getTitle().'/'.$image->getFile()->getClientOriginalName());
    $image->getFile()->move($dirPosts,$image->getFile()->getClientOriginalName());

    }
        $posts->setDatePublish($dateNow);
        $em = $this->getDoctrine()->getManager();
   		$em->persist($posts);
    	$em->flush();
    	$this->addFlash('registred', 'Oui oui, ilest bien enregistrée !');
    	//return $this->redirectToRoute('admin_posts_add');

     }
    
		return $this->render('AdminAdminBundle:Posts:formpostslayout.html.twig',array('form'=>$form->createView()));
	}





	public function IndexAction(){
            return $this->render('AdminAdminBundle:Default:accueil.html.twig');

	}
	public function UpdatePostsaction(){
            return $this->render('AdminAdminBundle:Default:accueil.html.twig');
	}

}