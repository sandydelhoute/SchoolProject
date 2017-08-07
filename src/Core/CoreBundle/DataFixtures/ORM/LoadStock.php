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

/* STOCK PRODUCT RELAIS 1 */
$stock=new Stock();
$stock->setQuantity(10);
$stock->setRelais($this->getReference('relais'));
$stock->setProduct($this->getReference('product1'));

$stock1=new Stock();
$stock1->setQuantity(10);
$stock1->setRelais($this->getReference('relais'));
$stock1->setProduct($this->getReference('product2'));

$stock2=new Stock();
$stock2->setQuantity(10);
$stock2->setRelais($this->getReference('relais'));
$stock2->setProduct($this->getReference('product3'));

$stock3=new Stock();
$stock3->setQuantity(10);
$stock3->setRelais($this->getReference('relais'));
$stock3->setProduct($this->getReference('product4'));

$stock4=new Stock();
$stock4->setQuantity(5);
$stock4->setRelais($this->getReference('relais'));
$stock4->setProduct($this->getReference('product5'));

$stock5=new Stock();
$stock5->setQuantity(5);
$stock5->setRelais($this->getReference('relais'));
$stock5->setProduct($this->getReference('product6'));

$stock6=new Stock();
$stock6->setQuantity(5);
$stock6->setRelais($this->getReference('relais'));
$stock6->setProduct($this->getReference('product7'));

$stock7=new Stock();
$stock7->setQuantity(7);
$stock7->setRelais($this->getReference('relais'));
$stock7->setProduct($this->getReference('product8'));


$stock8=new Stock();
$stock8->setQuantity(7);
$stock8->setRelais($this->getReference('relais'));
$stock8->setProduct($this->getReference('product11'));


$stock9=new Stock();
$stock9->setQuantity(10);
$stock9->setRelais($this->getReference('relais'));
$stock9->setProduct($this->getReference('product12'));

/* STOCK PRODUCT RELAIS 2 */
$stock10=new Stock();
$stock10->setQuantity(10);
$stock10->setRelais($this->getReference('relais1'));
$stock10->setProduct($this->getReference('product2'));

$stock11=new Stock();
$stock11->setQuantity(10);
$stock11->setRelais($this->getReference('relais1'));
$stock11->setProduct($this->getReference('product3'));

$stock12=new Stock();
$stock12->setQuantity(10);
$stock12->setRelais($this->getReference('relais1'));
$stock12->setProduct($this->getReference('product4'));

$stock13=new Stock();
$stock13->setQuantity(5);
$stock13->setRelais($this->getReference('relais1'));
$stock13->setProduct($this->getReference('product5'));

$stock14=new Stock();
$stock14->setQuantity(5);
$stock14->setRelais($this->getReference('relais1'));
$stock14->setProduct($this->getReference('product6'));

$stock15=new Stock();
$stock15->setQuantity(5);
$stock15->setRelais($this->getReference('relais1'));
$stock15->setProduct($this->getReference('product7'));

$stock16=new Stock();
$stock16->setQuantity(7);
$stock16->setRelais($this->getReference('relais1'));
$stock16->setProduct($this->getReference('product8'));


$stock17=new Stock();
$stock17->setQuantity(7);
$stock17->setRelais($this->getReference('relais1'));
$stock17->setProduct($this->getReference('product11'));


$stock18=new Stock();
$stock18->setQuantity(10);
$stock18->setRelais($this->getReference('relais1'));
$stock18->setProduct($this->getReference('product12'));


$manager->persist($stock);
$manager->persist($stock1);
$manager->persist($stock2);
$manager->persist($stock3);
$manager->persist($stock4);
$manager->persist($stock5);
$manager->persist($stock6);
$manager->persist($stock7);
$manager->persist($stock8);
$manager->persist($stock9);
$manager->persist($stock10);
$manager->persist($stock11);
$manager->persist($stock12);
$manager->persist($stock13);
$manager->persist($stock14);
$manager->persist($stock15);
$manager->persist($stock16);
$manager->persist($stock17);
$manager->persist($stock18);
$manager->flush();
}
    public function getOrder()
    {
        return 10;
    }
}