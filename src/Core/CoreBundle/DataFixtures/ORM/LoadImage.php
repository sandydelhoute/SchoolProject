<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Images;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class LoadImage extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){

$image=new Images();
$image->setPath("img/fixtures/fixture.png");
$image->setAlt('fixture');
$this->addReference('image',$image);
$manager->persist($image);
$manager->flush();
}
    public function getOrder()
    {
        return 5;
    }
}