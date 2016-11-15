<?php

namespace Vendor\ConnectUsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('VendorConnectUsersBundle:Default:index.html.twig');
    }
}
