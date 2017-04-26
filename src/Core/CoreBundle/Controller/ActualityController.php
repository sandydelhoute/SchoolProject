<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ActualityController extends Controller
{


    public function actualityAction()
   {
       return $this->render('CoreCoreBundle:Actuality:actualitylayout.html.twig');

   }

}