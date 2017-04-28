<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommandeController extends Controller
{
     public function commandeAction()
    {

        return $this->render('CoreCoreBundle:Commande:commandelayout.html.twig');
    }
     public function panierAction()
    {

        return $this->render('CoreCoreBundle:Commande:panierlayout.html.twig');
    }

     public function ajoutPanierAction()
    {

        return $this->render('CoreCoreBundle:Mentions:mentionslayout.html.twig');
    }
    
}
