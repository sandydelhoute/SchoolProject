<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Stock;
use \DateTime;


class LoadStock extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){

$stock=new Stock();
$stock->setQuantity(10);
$stock->setRelais($this->getReference('relais'));
$stock->setProduct($this->getReference('product'));

// $stock1=new Stock();
// $stock1->setQuantity();
// $stock1->setRelais($this->getReference('relais1'));
// $stock1->setProduct($this->getReference('product'));

$manager->persist($stock);
$manager->flush();
}
    public function getOrder()
    {
        return 12;
    }
}