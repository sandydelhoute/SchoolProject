<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{

     public function contactAction()
    {
        return $this->render('CoreCoreBundle:Contact:contactlayout.html.twig');

    }


}