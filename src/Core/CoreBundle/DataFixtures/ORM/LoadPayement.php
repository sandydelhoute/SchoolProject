<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Payement;


class LoadPayement extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){

$payement=new Payement();
$payement->setType('paypal');

$payement1=new Payement();
$payement1->setType('carte bleu');

$payement2=new Payement();
$payement2->setType('mon compte');

$payement3=new Payement();
$payement3->setType('applepay');


$manager->persist($payement);
$manager->persist($payement1);
$manager->persist($payement2);
$manager->persist($payement3);
$manager->flush();
}
    public function getOrder()
    {
        return 12;
    }
}