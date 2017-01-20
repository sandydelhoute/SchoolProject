<?php

namespace Vendor\ConnectUsersBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vendor\ConnectUsersBundle\Entity\users;

class Loadusers implements FixtureInterface
{

public Function load(ObjectManager $manager){

$users = new Users();
$users->setName('sandy');
$users->setFirstname('delhoute');
$users->setEmail('sdelhoute@gmail.com');
$users->setPassword('123456');
$users1 = new Users();
$users1->setName('guillaume');
$users1->setFirstname('lemaire');
$users1->setEmail('wl.guillaume@gmail.com');
$users1->setPassword('123456');
$users2 = new Users();
$users2->setName('fabien');
$users2->setFirstname('coo');
$users2->setEmail('fabien.coo@gmail.com');
$users2->setPassword('123456');


$manager->persist($users);
$manager->persist($users1);
$manager->persist($users2);

$manager->flush();


}

}