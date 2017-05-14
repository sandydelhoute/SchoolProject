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

$coordonates=new Coordonates();
$coordonates->setLongitude(50.2892587);
$coordonates->setLatitude(2.7328427);
$this->addReference('coordonates1',$coordonates);

$manager->persist($coordonates);
$manager->flush();
}
    public function getOrder()
    {
        return 9;
    }
}
