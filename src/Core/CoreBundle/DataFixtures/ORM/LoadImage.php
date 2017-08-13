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
$image->setPath("/img/fixtures/desserts/fondant-chocolat.jpg");
$image->setAlt('Fondant au chocolat');
$this->addReference('image',$image);
$manager->persist($image);

$image1=new Images();
$image1->setPath("/img/fixtures/plats/mafe.jpg");
$image1->setAlt('Mafé');
$this->addReference('image1',$image1);
$manager->persist($image1);

$image2=new Images();
$image2->setPath("/img/fixtures/plats/poulet-braise.jpg");
$image2->setAlt('Poulet braisé');
$this->addReference('image2',$image2);
$manager->persist($image2);

$image3=new Images();
$image3->setPath("/img/fixtures/desserts/tiramisu-speculoos.jpg");
$image3->setAlt('Tiramisu aux speculoos');
$this->addReference('image3',$image3);
$manager->persist($image3);

$image4=new Images();
$image4->setPath("/img/fixtures/entrees/verrines-crabe.jpg");
$image4->setAlt('Verrines crabe');
$this->addReference('image4',$image4);
$manager->persist($image4);

$image5=new Images();
$image5->setPath("/img/fixtures/plats/risotto-homard.jpeg");
$image5->setAlt('Risotto homard');
$this->addReference('image5',$image5);
$manager->persist($image5);

$image6=new Images();
$image6->setPath("/img/fixtures/entrees/salade-cesar.jpg");
$image6->setAlt('Salade César');
$this->addReference('image6',$image6);
$manager->persist($image6);

$image7=new Images();
$image7->setPath("/img/fixtures/plats/supremes-chapon.jpg");
$image7->setAlt('Suprêmes de châpon');
$this->addReference('image7',$image7);
$manager->persist($image7);

$image8=new Images();
$image8->setPath("/img/fixtures/plats/salade-pates.jpg");
$image8->setAlt('Salade de pâtes');
$this->addReference('image8',$image8);
$manager->persist($image8);

$image9=new Images();
$image9->setPath("/img/fixtures/plats/tajine-agneau.jpg");
$image9->setAlt('Tajine d\'agneau');
$this->addReference('image9',$image9);
$manager->persist($image9);

$image10=new Images();
$image10->setPath("/img/fixtures/plats/gratin-dauphinois.jpg");
$image10->setAlt('Gratin dauphinois');
$this->addReference('image10',$image10);
$manager->persist($image10);

$image11=new Images();
$image11->setPath("/img/fixtures/desserts/fondant-chocolat.jpg");
$image11->setAlt('Fondant au chocolat');
$this->addReference('image11',$image11);
$manager->persist($image);

$image12=new Images();
$image12->setPath("/img/fixtures/desserts/fondant-chocolat.jpg");
$image12->setAlt('Fondant au chocolat');
$this->addReference('image12',$image12);


$image13=new Images();
$image13->setPath("/img/fixtures/boisson/images.jpg");
$image13->setAlt('Grand cru');
$this->addReference('image13',$image13);

$image14=new Images();
$image14->setPath("/img/fixtures/boisson/images1.jpg");
$image14->setAlt('leffe');
$this->addReference('image14',$image14);

}
    public function getOrder()
    {
        return 6;
    }
}