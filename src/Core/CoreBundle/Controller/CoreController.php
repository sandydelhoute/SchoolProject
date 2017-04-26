<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
     public function resetPasswordAction()
    {

        return $this->render('CoreCoreBundle:ResetPassword:resetpasswordlayout.html.twig');
    }
    
   
}
