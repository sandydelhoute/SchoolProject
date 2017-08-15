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
        $content0 = "Nous sommes heureux de vous annoncer que de nouveaux points de livraison sont désormais disponibles pour vous! Désormais vous avez la possibilité d'être livré à Mons-en-Baroeul et La Madeleine.";
        $posts=new Posts();
        $posts->setTitle("Nouveaux points de livraison");
        $posts->setDatePublish(new DateTime('Now'));
        $posts->setContent($content0);
        $posts->addImage($this->getReference('image'));
        $posts->setHomePage(true);
        $manager->persist($posts);

        $content1 = "Profitez dès à présent de nouveaux plats confectionnés par nos partenaires, dans une alliance parfaite entre gastronomie et simplicité.";
        $posts1=new Posts();
        $posts1->setTitle("Nouvelle carte");
        $posts1->setDatePublish(new DateTime('Now'));
        $posts1->setContent($content1);
        $posts1->addImage($this->getReference('image'));
        $posts1->setHomePage(true);
        $manager->persist($posts1);

        $content2 = "Meal & Box recrute de nouveaux partenaires pour continuer à agrandir et enrichir notre aventurre ! Si vous avez un profil commercial, ou si vous souhaiter créer de nouveaux menus pour nous, n'hésitez pas à nous contacter via le formulaire du site.";
        $posts2=new Posts();
        $posts2->setTitle("Meal & Box recrute !");
        $posts2->setDatePublish(new DateTime('Now'));
        $posts2->setContent($content2);
        $posts2->addImage($this->getReference('image'));
        $posts2->setHomePage(true);
        $manager->persist($posts2);
        


        for ($i=0; $i < 10; $i++) {
            $posts=new Posts();
            $posts->setTitle("Suprêmes de chapon");
            $posts->setDatePublish(new DateTime('Now'));
            $posts->setContent($content);
            $posts->addImage($this->getReference('image'));
            $manager->persist($posts);
        }
        $manager->flush();

    }
    public function getOrder()
    {
        return 11;
    }
}
