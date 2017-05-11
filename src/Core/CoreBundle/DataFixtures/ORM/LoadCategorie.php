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
$this->addReference('categorieParent',$categorie);
$categorie1=new Categorie();
$categorie1->setName("Viande");
$this->addReference('categorieProcduct',$categorie);
$categorie1->setParents($this->getReference('categorieParent'));
$manager->persist($categorie1);
$manager->persist($categorie);
$manager->flush();
}
    public function getOrder()
    {
        return 3;
    }
}