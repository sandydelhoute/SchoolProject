<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Coordonates;
use \DateTime;


class LoadCoordonates extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){

$coordonates=new Coordonates();
$coordonates->setLongitude(50.6711211);
$coordonates->setLatitude(3.2088457999999997);
$this->addReference('coordonates',$coordonates);
$manager->persist($coordonates);

$coordonates1=new Coordonates();
$coordonates1->setLongitude(50.2892587);
$coordonates1->setLatitude(2.7328427);
$this->addReference('coordonates1',$coordonates1);
$manager->persist($coordonates1);


$coordonates2=new Coordonates();
$coordonates2->setLongitude(50.70147);
$coordonates2->setLatitude(3.2130223);
$this->addReference('coordonates2',$coordonates2);
$manager->persist($coordonates2);

$coordonates3=new Coordonates();
$coordonates3->setLongitude(50.6713532);
$coordonates3->setLatitude(3.2220136);
$this->addReference('coordonates3',$coordonates3);
$manager->persist($coordonates3);

$manager->flush();
}
    public function getOrder()
    {
        return 1;
    }
}
