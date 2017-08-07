<?php

namespace Core\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializationContext;

class SitemapController extends Controller
{

    public function siteMapAction($name)
    {
    	if(method_exists($this->get('sitemap'),$name))
    		$urls=$this->get('sitemap')->$name();
    	else
    		$urls=$this->get('sitemap')->index();


        return $this->render(
            'CoreCoreBundle:Sitemap:sitemap_index.xml.twig',
            array('urls'=>$urls)
        );
    }

}


