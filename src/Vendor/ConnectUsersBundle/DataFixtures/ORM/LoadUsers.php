<?php

namespace Vendor\ConnectUsersBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Vendor\ConnectUsersBundle\Entity\usersweb;
use Vendor\ConnectUsersBundle\Entity\usersemployee;
use Vendor\ConnectUsersBundle\Entity\status;
use \DateTime;


class Loadusers  extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{

 /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


public Function load(ObjectManager $manager){

$encoder = $this->container->get('security.password_encoder');


for($i=0;$i<20;$i++)
{
$users = new Usersweb();
$usersemployee = new usersemployee();
$password = $encoder->encodePassword($users, '123456');
$password1 = $encoder->encodePassword($usersemployee, '123456');
$users->setName('sandy');
$users->setFirstname('delhoute');
$users->setEmail('mail'.$i.'@mail.com');
$users->setPassword($password);
$usersemployee->setName('fabien');
$usersemployee->setFirstname('coo');
$usersemployee->setEmail("mail".$i."@mealandbox.fr");
$usersemployee->setPassword($password1);
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