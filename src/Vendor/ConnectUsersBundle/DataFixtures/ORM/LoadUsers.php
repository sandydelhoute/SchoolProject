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


for($i=0;$i<25;$i++)
{
$users = new Usersweb();
$password = $encoder->encodePassword($users, '123456');
$users->setName('sandy');
$users->setFirstname('delhoute');
$users->setEmail('mail'.$i.'@mail.com');
$users->setPassword($password);
$users->setRelais($this->getReference('relais'));
$manager->persist($users);
}



$usersemployee = new UsersEmployee();
$usersemployee->setFirstname('fabien');
$usersemployee->setName('coo');
$usersemployee->setEmail("mail@mealandbox.fr");
$password1 = $encoder->encodePassword($usersemployee, '123456');
$usersemployee->setPassword($password1);
$usersemployee->setBirthdate(new DateTime('02/31/2011'));
$usersemployee->setHiredate(new DateTime());
$usersemployee->setStatus($this->getReference('SUPERADMIN'));
$manager->persist($usersemployee);



$usersemployee1 = new UsersEmployee();
$usersemployee1->setFirstname('fabien1');
$usersemployee1->setName('coo1');
$usersemployee1->setEmail("mail0@mealandbox.fr");
$password2 = $encoder->encodePassword($usersemployee1, '123456');
$usersemployee1->setPassword($password2);
$usersemployee1->setBirthdate(new DateTime('02/31/2011'));
$usersemployee1->setHiredate(new DateTime());
$usersemployee1->setStatus($this->getReference('SUPERADMIN'));
$manager->persist($usersemployee1);



$usersemployee2 = new UsersEmployee();
$usersemployee2->setFirstname('admin');
$usersemployee2->setName('coo2');
$usersemployee2->setEmail("mail1@mealandbox.fr");
$password3 = $encoder->encodePassword($usersemployee2, '123456');
$usersemployee2->setPassword($password3);
$usersemployee2->setBirthdate(new DateTime('02/31/2011'));
$usersemployee2->setHiredate(new DateTime());
$usersemployee2->setStatus($this->getReference('ADMIN'));
$manager->persist($usersemployee2);



$usersemployee3 = new UsersEmployee();
$usersemployee3->setFirstname('livreur');
$usersemployee3->setName('coo3');
$usersemployee3->setEmail("mail2@mealandbox.fr");
$password4 = $encoder->encodePassword($usersemployee3, '123456');
$usersemployee3->setPassword($password4);
$usersemployee3->setBirthdate(new DateTime('02/31/2011'));
$usersemployee3->setHiredate(new DateTime());
$usersemployee3->setStatus($this->getReference('LIVREUR'));
$manager->persist($usersemployee3);


$manager->flush();


}
 public function getOrder()
    {
        return 13;
    }
}