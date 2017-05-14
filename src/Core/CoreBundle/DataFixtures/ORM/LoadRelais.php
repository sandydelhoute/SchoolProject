<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Relais;
use \DateTime;


class LoadRelais extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){

$relais=new Relais();
$relais->setName("Café du coin");
$relais->setCoordonates($this->getReference('coordonates'));
$relais->setOpening($this->getReference('opening'));

$relais1=new Relais();
$relais1->setName("Technopôle");
$relais1->setCoordonates($this->getReference('coordonates1'));
$relais1->setOpening($this->getReference('opening'));

$manager->persist($relais1);
$manager->persist($relais);
$manager->flush();
}
    public function getOrder()
    {
        return 11;
    }
}