<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Vendor\ConnectUsersBundle\form\ResetPasswordType;
use Symfony\Component\HttpFoundation\Request;
use \DateTime;
class CoreController extends Controller
{
     public function accueilAction()
    {

        return $this->render('CoreCoreBundle:Accueil:accueillayout.html.twig');
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
