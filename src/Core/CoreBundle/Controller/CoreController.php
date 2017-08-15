<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Vendor\ConnectUsersBundle\form\ResetPasswordType;
use Symfony\Component\HttpFoundation\Request;
use \DateTime;
use Core\CoreBundle\Entity\SearchAddress;
use Core\CoreBundle\Form\SearchAddressType;
class CoreController extends Controller
{
     public function accueilAction(Request $request)
    {
        $searchAddress = new SearchAddress();
        $em = $this->getDoctrine()->getManager();
        $listePosts = $em->getRepository("CoreCoreBundle:Posts")->findByHomePage(true);
        $form = $this->createForm(SearchAddressType::class,$searchAddress);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('relaispageparams', array('address' => $searchAddress->getAddress()));
        }
        $response = $this->render('CoreCoreBundle:Accueil:accueillayout.html.twig',array('form'=>$form->createView(),'listeposts'=>$listePosts));
        $response = $this->container->get('meta')->metaDonnees($response,
            array('title'=>"tototo",
                  'description'=>'dfsdfsdfsdfsd',
                  'openGraph'=>array(
                    'title'=>"",
                    'type'=>"",
                    'url'=>""),
                  'twitter'=>array(
                    ''=>"",
                    ''=>""),
                  'googlePlus'=>array(
                    ''=>"")

                  ));

        return $response;
    }
     public function cgvAction()
    {

        return $this->render('CoreCoreBundle:Cgv:cgvlayout.html.twig');
    }

     public function mentionsAction()
    {

        return $this->render('CoreCoreBundle:Mentions:mentionslayout.html.twig');
    }



     public function resetPasswordAction($token,Request $request)
    {

    $em = $this->getDoctrine()->getManager();
    $usersWeb=$em->getRepository('VendorConnectUsersBundle:UsersWeb')
    ->findOneByTokenResetPass($token);

    if(is_null($usersWeb))
        throw new NotFoundHttpException('Sorry not existing!');

    if($usersWeb->getLimiteDateREsetPass()< new \DateTime('now'))
            throw new NotFoundHttpException('Sorry not existing!');

    $form = $this->createForm(\Vendor\ConnectUsersBundle\Form\ResetPasswordType::class,$usersWeb);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $password = $this->get('security.password_encoder')
            ->encodePassword($usersWeb,$usersWeb->getPlainPassword());
        $usersWeb->setPassword($password);
        $usersWeb->setTokenResetPass(null);    
        $usersWeb->setLimiteDateResetPass(null);
        $em->persist($usersWeb);
        $em->flush();
    }
        return $this->render('CoreCoreBundle:ResetPassword:resetpasswordlayout.html.twig',array('form' => $form->createView()));
    }
    
   
}
