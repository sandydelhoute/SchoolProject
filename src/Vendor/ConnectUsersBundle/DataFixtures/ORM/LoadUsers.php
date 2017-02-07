<?php

namespace Vendor\ConnectUsersBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vendor\ConnectUsersBundle\Entity\usersweb;
use Vendor\ConnectUsersBundle\Entity\usersemployee;
use Vendor\ConnectUsersBundle\Entity\status;
use \DateTime;


class Loadusers  extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){


for($i=0;$i<5;$i++)
{
$users = new Usersweb();
$users->setName('sandy');
$users->setFirstname('delhoute');
$users->setEmail('sdelhoute'.$i.'@gmail.com');
$users->setPassword(hash('sha1','123456'));
$usersemployee = new usersemployee();
$usersemployee->setName('fabien');
$usersemployee->setFirstname('coo');
$usersemployee->setEmail("fabien".$i."@mealandbox.fr");
$usersemployee->setPassword(hash('sha512','0123456'));
$usersemployee->setBirthdate(new DateTime('02/31/2011'));
$usersemployee->setNumbersocial('188115912345678');
$usersemployee->setStatus($this->getReference('status'));
$manager->persist($usersemployee);
$manager->persist($users);
}


$manager->flush();


}
 public function getOrder()
    {
        return 2;
    }
}