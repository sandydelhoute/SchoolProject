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
10=>"Sésame");
$composition=
	'
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed gravida nunc eu ligula luctus, et efficitur est tincidunt. Praesent sed egestas velit. Sed eros felis, placerat eu convallis non, sagittis sollicitudin massa. Donec sit amet elit risus. Integer quis volutpat enim. Etiam felis eros, aliquet sed posuere ac, consequat at felis. Nullam eu elit ac mi imperdiet congue quis non dui. Mauris pulvinar ornare ante non faucibus.

Praesent fermentum, nulla in porta sagittis, nulla tellus porta massa, et porttitor arcu erat non dui. Vestibulum vulputate tristique nisi, at tincidunt felis pharetra et. Duis varius nec libero sed facilisis. Nullam ut hendrerit velit, sed auctor augue. Ut porta iaculis ligula, in facilisis ipsum. Nunc fringilla ac nulla a fermentum. Vestibulum placerat diam non ultrices maximus. Nam ullamcorper ex sed aliquet sodales. Suspendisse potenti. Mauris tristique est sed lobortis accumsan. Maecenas consequat, ante id mattis luctus, dolor magna mollis ligula, sit amet faucibus urna odio at mi. Ut tortor ipsum, elementum non feugiat sodales, mollis convallis nisi. Vestibulum convallis viverra volutpat. Nam auctor purus id tristique congue. Nullam at risus null';
$allergene =new Allergene();
for($i =0;$i<=10;$i++){
$product=new Product();
$product->setName("babar");
$product->setActive(True);
$product->setPrix($prix+$i);
$product->setProviders($this->getReference('Provider'));
$product->setComposition($composition);
$product->setDescription($composition);
$product->addAllergene($this->getReference($listAllergene[$i]));
$product->addCategory($this->getReference('categorieProcduct'));
$product->addImage($this->getReference('image'));
$manager->persist($product);
$manager->flush();
}
}
    public function getOrder()
    {
        return 7;
    }
}
