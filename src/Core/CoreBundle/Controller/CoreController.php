<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
     public function accueilAction()
    {

        return $this->render('CoreCoreBundle:Default:accueil.html.twig');
    }
    

     public function contactAction()
    {
        return $this->render('CoreCoreBundle:Default:contact.html.twig');

    }
}
