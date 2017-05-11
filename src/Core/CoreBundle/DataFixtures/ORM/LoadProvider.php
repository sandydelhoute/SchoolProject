<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Provider;
use \DateTime;


class LoadProvider extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){

$provider=new Provider();
$provider->setName("babar");
$manager->persist($provider);
$manager->flush();
}
    public function getOrder()
    {
        return 6;
    }
}