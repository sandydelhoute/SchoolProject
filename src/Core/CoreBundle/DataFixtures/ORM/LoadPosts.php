<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Posts;
use \DateTime;


class LoadPosts extends AbstractFixture implements OrderedFixtureInterface
{

    public Function load(ObjectManager $manager){
        $content = "Vous l'attendiez depuis longtemps : le voici enfin ! Découvrez sans plus tarder notre nouvelle recette de suprêmes de chapon aux épices.";

        for ($i=0; $i < 10; $i++) { 
            $posts=new Posts();
            $posts->setTitle("Suprêmes de chapon");
            $posts->setDatePublish(new DateTime('Now'));
            $posts->setContent($content);
            $posts->addImage($this->getReference('image'));
            $manager->persist($posts);
            $manager->flush();
        }
    }
    public function getOrder()
    {
        return 8;
    }
}