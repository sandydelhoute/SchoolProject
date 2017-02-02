<?php

namespace Vendor\ConnectUsersBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vendor\ConnectUsersBundle\Entity\usersweb;
use Vendor\ConnectUsersBundle\Entity\usersemployee;
use Symfony\Component\Validator\Constraints\DateTime;
class Loadusers implements FixtureInterface
{

public Function load(ObjectManager $manager){

$users = new Usersweb();
$users->setName('sandy');
$users->setFirstname('delhoute');
$users->setEmail('sdelhoute@gmail.com');
$users->setPassword(hash('sha1','123456'));
$users1 = new Usersweb();
$users1->setName('guillaume');
$users1->setFirstname('lemaire');
$users1->setEmail('wl.guillaume@gmail.com');
$users1->setPassword(hash('sha1','123456'));
$users2 = new usersweb();
$users2->setName('fabien');
$users2->setFirstname('coo');
$users2->setEmail('fabien.coo@gmail.com');
$users2->setPassword(hash('sha1','123456'));
$usersemployee = new usersemployee();
$usersemployee->setName('fabien');
$usersemployee->setFirstname('coo');
$usersemployee->setEmail('fabien.coo@mealandbox.fr');
$usersemployee->setPassword(hash('sha1','0123456'));
$usersemployee->setBirthdate(new DateTime('02/31/2011'));
$usersemployee->setNumbersocial('188115912345678');




$manager->persist($users);
$manager->persist($users1);
$manager->persist($users2);

$manager->persist($usersemployee);

$manager->flush();


}

}