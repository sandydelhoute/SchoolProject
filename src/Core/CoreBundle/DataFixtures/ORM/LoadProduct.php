<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Product;
use Core\CoreBundle\Entity\Allergene;
use Core\CoreBundle\Entity\Provider;
use \DateTime;


class LoadProduct extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){

    $prix=2.99;
    $listAllergene=array(
        0=>"Gluten",
        1=>"Crustacés",
        2=>"Oeufs",
        3=>"Poissons",
        4=>"Arachides",
        5=>"Lait",
        6=>"Soja",
        7=>"Fruits à coques",
        8=>"Céleri",
        9=>"Moutarde",
        10=>"Sésame"
    );

    $description= 'Dessert par excellence, le fondant au chocolat n\'a pas fini de vous surprendre ! Sa texture fondante et son goût prononcé concluront votre repas par une note douce et savoureuse.';

    $description1= 'Profitez de votre repas pour découvrir les quatre coins du monde ! En effet, le Sénégal vous attend dès maintenant avec son plat typique africain : le mafé ! Prenez le goût du pays.';

    $description2= 'Afin de vous offrir un plat savoureux, notre poulet braisé est préparé avec soin avec des poulets élevés en plein air. Accompagné de riz, il vous offrira une pause culinaire qui ravira vos papilles.';

    $description3= 'Afin de vous offrir un plat savoureux, notre poulet braisé est préparé avec soin avec des poulets élevés en plein air. Accompagné de riz, il vous offrira une pause culinaire qui ravira vos papilles.';

    $description4= 'Très frais en bouche, la verrine de crabe à l\'avocat reste un classique trés recommandé.';

    $description5= 'Le risotto de homard est un plat très recommandé pour les amateurs de crustacés, suivi de son risotto crémeux et fondant.';

    $description6= 'La salade césar au poulet est un plat typiquement italien. Avec un coté craquant avec les croûtons, et moelleux avec le poulet, elle est diversifiée lors de la mise en bouche.';

    $description7= 'Agréable en bouche, le suprême de châpons aux épices reste un plat très demandé, tout en étant accompagné de la purée de potiron et marrons qui reste un succès.';

    $description8= 'Cette salade de pâtes melangé avec avec son thon et son poivron, reste trés fraîche en bouche.';

    $description9= 'Le tajine d\'agneau aux pruneaux est un plat traditonnel. Accompagné de son citron ainsi que ses épices, le tajine vous révèle ses différentes saveurs.';

    $description10= 'Degustez notre fameux gratin dauphinois aux lardons. Son fromage grattiné ainsi que ses lardons.';

        $allergene =new Allergene();

        $product=new Product();
        $product->setName("Fondant au chocolat");
        $product->setActive(True);
        $product->setPrix($prix);
        $product->setProvider($this->getReference('Provider'));
        $product->setComposition($description);
        $product->setDescription($description);
        $product->addAllergene($this->getReference($listAllergene[2]));
        $product->addCategory($this->getReference('categorieProcduct'));
        $product->addImage($this->getReference('image'));
        $manager->persist($product);

        $product1=new Product();
        $product1->setName("Mafé");
        $product1->setActive(True);
        $product1->setPrix($prix+1);
        $product1->setProvider($this->getReference('Provider'));
        $product1->setComposition($description1);
        $product1->setDescription($description1);
        $product1->addAllergene($this->getReference($listAllergene[4]));
        $product1->addCategory($this->getReference('categorieProcduct'));
        $product1->addImage($this->getReference('image1'));
        $this->addReference('product1',$product1);
        $manager->persist($product1);

        $product2=new Product();
        $product2->setName("Poulet braisé");
        $product2->setActive(True);
        $product2->setPrix($prix+2);
        $product2->setProvider($this->getReference('Provider'));
        $product2->setComposition($description2);
        $product2->setDescription($description2);
        $product2->addAllergene($this->getReference($listAllergene[0]));
        $product2->addCategory($this->getReference('categorieProcduct'));
        $product2->addImage($this->getReference('image2'));
        $this->addReference('product2',$product2);
        $manager->persist($product2);

        $product3=new Product();
        $product3->setName("Tiramisu");
        $product3->setActive(True);
        $product3->setPrix($prix+3);
        $product3->setProvider($this->getReference('Provider'));
        $product3->setComposition($description3);
        $product3->setDescription($description3);
        $product3->addAllergene($this->getReference($listAllergene[2]));
        $product3->addCategory($this->getReference('categorieProcduct'));
        $product3->addImage($this->getReference('image3'));
        $this->addReference('product3',$product3);
        $manager->persist($product3);

        $product4=new Product();
        $product4->setName("Verrines de crabe à l'avocat");
        $product4->setActive(True);
        $product4->setPrix($prix+4);
        $product4->setProvider($this->getReference('Provider'));
        $product4->setComposition($description4);
        $product4->setDescription($description4);
        $product4->addAllergene($this->getReference($listAllergene[1]));
        $product4->addCategory($this->getReference('categorieProcduct'));
        $product4->addImage($this->getReference('image4'));
        $this->addReference('product4',$product4);
        $manager->persist($product4);

        $product5=new Product();
        $product5->setName("Risotto de homard");
        $product5->setActive(True);
        $product5->setPrix($prix+5);
        $product5->setProvider($this->getReference('Provider'));
        $product5->setComposition($description5);
        $product5->setDescription($description5);
        $product5->addAllergene($this->getReference($listAllergene[7]));
        $product5->addCategory($this->getReference('categorieProcduct'));
        $product5->addImage($this->getReference('image5'));
        $this->addReference('product5',$product5);
        $manager->persist($product5);

        $product6=new Product();
        $product6->setName("Salade césar au poulet");
        $product6->setActive(True);
        $product6->setPrix($prix+6);
        $product6->setProvider($this->getReference('Provider'));
        $product6->setComposition($description6);
        $product6->setDescription($description6);
        $product6->addAllergene($this->getReference($listAllergene[2]));
        $product6->addCategory($this->getReference('categorieProcduct'));
        $product6->addImage($this->getReference('image6'));
        $this->addReference('product6',$product6);
        $manager->persist($product6);

        $product7=new Product();
        $product7->setName("Suprême de chapon aux épices");
        $product7->setActive(True);
        $product7->setPrix($prix+7);
        $product7->setProvider($this->getReference('Provider'));
        $product7->setComposition($description7);
        $product7->setDescription($description7);
        $product7->addAllergene($this->getReference($listAllergene[0]));
        $product7->addCategory($this->getReference('categorieProcduct'));
        $product7->addImage($this->getReference('image7'));
        $this->addReference('product7',$product7);
        $manager->persist($product7);

        $product8=new Product();
        $product8->setName("Salade de pâtes aux poivrons et au thon");
        $product8->setActive(True);
        $product8->setPrix($prix+8);
        $product8->setProvider($this->getReference('Provider'));
        $product8->setComposition($description8);
        $product8->setDescription($description8);
        $product8->addAllergene($this->getReference($listAllergene[0]));
        $product8->addCategory($this->getReference('categorieProcduct'));
        $product8->addImage($this->getReference('image8'));
        $this->addReference('product8',$product8);
        $manager->persist($product8);

        $product9=new Product();
        $product9->setName("Tajine d'agneau aux pruneaux");
        $product9->setActive(True);
        $product9->setPrix($prix+9);
        $product9->setProvider($this->getReference('Provider'));
        $product9->setComposition($description9);
        $product9->setDescription($description9);
        $product9->addAllergene($this->getReference($listAllergene[10]));
        $product9->addCategory($this->getReference('categorieProcduct'));
        $product9->addImage($this->getReference('image9'));
        $manager->persist($product9);


        $product10=new Product();
        $product10->setName("Gratin dauphinois aux lardons");
        $product10->setActive(True);
        $product10->setPrix($prix+10);
        $product10->setProvider($this->getReference('Provider'));
        $product10->setComposition($description10);
        $product10->setDescription($description10);
        $product10->addAllergene($this->getReference($listAllergene[5]));
        $product10->addCategory($this->getReference('categorieProcduct'));
        $product10->addImage($this->getReference('image10'));
        $manager->persist($product10);
        $manager->flush();
    }

    public function getOrder()
    {
        return 9;
    }
}
