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
$this->addReference('relais',$relais);

$relais1=new Relais();
$relais1->setName("Technopôle");
$relais1->setCoordonates($this->getReference('coordonates1'));
$relais1->setOpening($this->getReference('opening'));
$this->addReference('relais1',$relais1);


$relais2=new Relais("mairie wattrelos");
$relais2->setName("");
$relais2->setCoordonates($this->getReference('coordonates2'));
$relais2->setOpening($this->getReference('opening'));
$this->addReference('relais2',$relais2);

$relais3=new Relais();
$relais3->setName("Technopôle");
$relais3->setCoordonates($this->getReference('coordonates3'));
$relais3->setOpening($this->getReference('opening'));
$this->addReference('relais3',$relais3);



$manager->persist($relais);
$manager->persist($relais1);
$manager->persist($relais2);
$manager->persist($relais3);
$manager->flush();
}
    public function getOrder()
    {
        return 3;
    }
}