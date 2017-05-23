<?php

namespace Vendor\ConnectUsersBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vendor\ConnectUsersBundle\Entity\usersweb;
use Vendor\ConnectUsersBundle\Entity\usersemployee;
use Vendor\ConnectUsersBundle\Entity\Status;
use \DateTime;


class LoadRole extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){

$status=new Status();
$status->setName("SUPERADMIN");
$status1=new Status();
$status1->setName("ADMIN");
$status2=new Status();
$status2->setName("LIVREUR");
$manager->persist($status);
$manager->persist($status1);
$manager->persist($status2);
$manager->flush();
$this->addReference('status', $status1);
}
    public function getOrder()
    {
        return 13;
    }
}