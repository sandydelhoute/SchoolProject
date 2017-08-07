<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Categorie;
use \DateTime;


class LoadCategorie extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){

$categorie=new Categorie();
$categorie->setName("Plat");
$categorie->setParents(null);
$this->addReference('Plat',$categorie);

$categorie1=new Categorie();
$categorie1->setName("Boisson");
$categorie1->setParents(null);
$this->addReference('Boisson',$categorie1);

$categorie2=new Categorie();
$categorie2->setName("Dessert");
$categorie2->setParents(null);
$this->addReference('Dessert',$categorie2);

$categorie3=new Categorie();
$categorie3->setName("Entrée");
$categorie3->setParents(null);
$this->addReference('Entrée',$categorie3);


$categorie4=new Categorie();
$categorie4->setName("Viande");
$categorie4->setParents($this->getReference('Plat'));
$this->addReference('categorieProcduct',$categorie);

$manager->persist($categorie);
$manager->persist($categorie1);
$manager->persist($categorie2);
$manager->persist($categorie3);
$manager->persist($categorie4);

$manager->flush();
}
    public function getOrder()
    {
        return 5;
    }
}