<?php

namespace Core\CoreBundle\DataFixtures\ORM;

// src/AppBundle/DataFixtures/ORM/LoadUserData.php
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Core\CoreBundle\Entity\Menu;
use \DateTime;


class LoadMenu extends AbstractFixture implements OrderedFixtureInterface
{

public Function load(ObjectManager $manager){


$prix=2.99;
$listeNom=array('Potion des îles','Festival de bulles','Le coffre au trésor','La rosée du matin');
$listeDescription=array('Voici une recette de magrets de canard que l\'on sert avec des flans de légumes. Le mélange de carottes, gingembre et céleris-raves d\'un côté et de succulents magrets arrosés de sauce au vin de l\'autre donne à ce plat un contraste de saveurs exquis.','Le boudin noir aux pommes c\'est une recette traditionnelle mais le boudin blanc aux pommes, c\'est délicieux aussi. À essayer pour Noël ou pour le réveillon.');
$listeComposition=array("1 litre de bouillon (frais si possible sinon diluer un bouillon cube dans de l'eau)
400 g de carottes épluchées et coupées en tranches
5 cm de gingembre épluché et découpé en petits morceaux
400 g de céleris-raves épluchés et coupés en tranches
6 œufs
40 cl de crème fraîche","6 boudins blancs
8 pommes bien fermes (4 + 4)
10 cl de calvados
10 cl de crème fraiche épaisse de Normandie
25 g de beurre
Un peu d'eau");

	$menu=new Menu();
	$menu->setName($listeNom[0]);
	$menu->setActive(True);
	$menu->setPrix($prix);
	$menu->setComposition($listeComposition[0]);
	$menu->setDescription($listeDescription[0]);
	$menu->addProduct($this->getReference('product3'));
	// $menu->addImage($this->getReference('image11'));
	$this->addReference('menu',$menu);


	$menu1=new Menu();
	$menu1->setName($listeNom[1]);
	$menu1->setActive(True);
	$menu1->setPrix($prix+1);
	$menu1->setComposition($listeComposition[1]);
	$menu1->setDescription($listeDescription[1]);
	$menu1->addProduct($this->getReference('product3'));
	// $menu->addImage($this->getReference('image11'));
	$this->addReference('menu1',$menu1);

	$manager->persist($menu);
	$manager->persist($menu1);
	$manager->flush();


}
    public function getOrder()
    {
        return 10;
    }
}