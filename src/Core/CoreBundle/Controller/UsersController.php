<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsersController extends Controller
{

  public function loginAction()
    {

        return $this->render('CoreCoreBundle:Login:loginlayout.html.twig');

    }

}