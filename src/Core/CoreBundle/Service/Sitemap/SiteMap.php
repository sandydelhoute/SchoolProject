<?php

namespace Core\CoreBundle\Service\Sitemap;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
class SiteMap
{
    private $router;
    private $em;

    public function __construct(RouterInterface $router, EntityManager $em)
    {
        $this->router = $router;
        $this->em = $em;
    }

    /**
     * Génère l'ensemble des valeurs des balises <url> du sitemap.
     *
     * @return array Tableau contenant l'ensemble des balise url du sitemap.
     */
    public function index()
    {
        $listMethode=get_class_methods($this);
        foreach ($listMethode as $methode) {
           //  var_dump($methode);
           // var_dump(!$methode != '__construct');
           //  exit; 
            if($methode !== '__construct' & $methode !== 'index')
            {      
                $urls[] = array(
                    'loc' => $this->router->generate('sitemap', array('name' =>$methode,'_format'=>'xml'), UrlGeneratorInterface::ABSOLUTE_URL)
                    );
            }

        }
        return $urls;
    }

  /* generate site map product */  
    public function product()
    {
        $urls = array();        

        $listProduct = $this->em->getRepository('CoreCoreBundle:Product')->findAll();

        foreach ($listProduct as $product) {
            $urls[] = array(
                'loc' => $this->router->generate('productdetailpage', array('id' => $product->getId()), UrlGeneratorInterface::ABSOLUTE_URL)
                );
        }

        return $urls;
    }

  /* generate site map menu */  
    public function menu()
    {
        $urls = array();        

        $listMenu= $this->em->getRepository('CoreCoreBundle:Menu')->findAll();

        foreach ($listMenu as $menu ) {
            $urls[] = array(
                'loc' => $this->router->generate('menudetailpage', array('id' => $menu->getId()), UrlGeneratorInterface::ABSOLUTE_URL)
                );
        }

        return $urls;
    }

  /* generate site map posts */  
    public function posts()
    {
        $urls = array();        

        $listPosts= $this->em->getRepository('CoreCoreBundle:Posts')->findAll();

        foreach ($listPosts as $post) {
            $urls[] = array(
                'loc' => $this->router->generate('actualitydetailpage', array('id' => $post->getId()), UrlGeneratorInterface::ABSOLUTE_URL)
                );
        }

        return $urls;
    }
} 