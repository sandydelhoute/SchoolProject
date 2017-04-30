<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class CommandeController extends Controller
{
     public function commandeAction()
    {

        return $this->render('CoreCoreBundle:Commande:commandelayout.html.twig');
    }
     public function panierAction(Request $request)
    {

        $session = $request->getSession();
        $listOrderLine=$session->get('panier');
        return $this->render('CoreCoreBundle:Commande:panierlayout.html.twig',array('listOrderLine'=>$listOrderLine));
    }
    
}
