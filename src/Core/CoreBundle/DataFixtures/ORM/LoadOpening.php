<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Opening;
use \DateTime;


class LoadOpening extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){

$date=new DateTime();
$open=$date->setTime (11,00);
$close=$date->setTime (14,00);
$delivry=$date->setTime (12,30);
$limit=$date->setTime (10,30);


$opening=new Opening();
$opening->setDayopen("Lundi");
$opening->setTimeopen($open);
$opening->setTimeclose($close);
$opening->setTimedelivry($delivry);
$opening->setTimelimitshop($limit);
$this->addReference('opening',$opening);
$manager->persist($opening);
$manager->flush();
}
    public function getOrder()
    {
        return 2;
    }
}