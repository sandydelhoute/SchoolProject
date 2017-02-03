<?php

namespace Vendor\ConnectUsersBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vendor\ConnectUsersBundle\Entity\usersweb;
use Vendor\ConnectUsersBundle\Entity\usersemployee;
use Vendor\ConnectUsersBundle\Entity\status;
use \DateTime;


class Loadusers implements FixtureInterface
{

public Function load(ObjectManager $manager){


$status=new status();
$status->setName("Super_Admin");
$users = new Usersweb();
$users->setName('sandy');
$users->setFirstname('delhoute');
$users->setEmail('sdelhoute@gmail.com');
$users->setPassword(hash('sha1','123456'));
$usersemployee = new usersemployee();
$usersemployee->setName('fabien');
$usersemployee->setFirstname('coo');
$usersemployee->setEmail('fabien.coo@mealandbox.fr');
$usersemployee->setPassword(hash('sha1','0123456'));
$usersemployee->setBirthdate(new DateTime('02/31/2011'));
$usersemployee->setNumbersocial('188115912345678');
$usersemployee->setStatus($status->getId());



$manager->persist($status);
$manager->persist($users);
$manager->persist($usersemployee);

$manager->flush();


}

}