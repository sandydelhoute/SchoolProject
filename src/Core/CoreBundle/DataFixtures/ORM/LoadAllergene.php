<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Allergene;
use \DateTime;


class LoadAllergene extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){

$ListAllergene=array(
0=>"Gluten",
1=>"Crustacés",
2=>"Oeufs",
3=>"Poissons",
4=>"Arachides",
5=>"Lait",
6=>"Soja",
7=>"Fruits à coques",
8=>"Céleri",
9=>"Moutarde",
10=>"Sésame");
foreach ($ListAllergene as $allergene=>$value) {
	$allergene =new Allergene();
	$allergene->setName($value);
	$this->addReference($value,$allergene);
	$manager->persist($allergene);
}
$manager->flush();
}
    public function getOrder()
    {
        return 4;
    }
}
