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

/* STOCK PRODUCT */
$stock=new Stock();
$stock->setQuantity(10);
$stock->setRelais($this->getReference('relais'));
$stock->setProduct($this->getReference('product1'));

$stock1=new Stock();
$stock1->setQuantity(10);
$stock1->setRelais($this->getReference('relais'));
$stock1->setProduct($this->getReference('product2'));

$stock2=new Stock();
$stock2->setQuantity(5);
$stock2->setRelais($this->getReference('relais1'));
$stock2->setProduct($this->getReference('product3'));

$stock3=new Stock();
$stock3->setQuantity(7);
$stock3->setRelais($this->getReference('relais1'));
$stock3->setProduct($this->getReference('product4'));

/* STOCK Menu */

$stock4=new Stock();
$stock4->setQuantity(7);
$stock4->setRelais($this->getReference('relais'));
$stock4->setMenu($this->getReference('menu'));


$stock5=new Stock();
$stock5->setQuantity(7);
$stock5->setRelais($this->getReference('relais1'));
$stock5->setMenu($this->getReference('menu1'));


$stock6=new Stock();
$stock6->setQuantity(7);
$stock6->setRelais($this->getReference('relais1'));
$stock6->setMenu($this->getReference('menu'));


$stock7=new Stock();
$stock7->setQuantity(7);
$stock7->setRelais($this->getReference('relais1'));
$stock7->setMenu($this->getReference('menu1'));

$manager->persist($stock);
$manager->persist($stock1);
$manager->persist($stock2);
$manager->persist($stock3);
$manager->persist($stock4);
$manager->persist($stock5);
$manager->persist($stock6);
$manager->persist($stock7);
$manager->flush();
}
    public function getOrder()
    {
        return 11;
    }
}