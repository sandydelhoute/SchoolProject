<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\CategorieRepository")
 */
class Categorie
{
   
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    
    /**
      *
      * @ORM\ManyToOne(targetEntity="categorie")
      * @ORM\JoinColumn(name="parents", referencedColumnName="id", nullable=true)
      */
    private $parents;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Categorie
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set parents
     *
     * @param integer $parents
     *
     * @return Categorie
     */
    public function setParents($parents)
    {
        $this->parents = $parents;

        return $this;
    }

    /**
     * Get parents
     *
     * @return int
     */
    public function getParents()
    {
        return $this->parents;
    }




    /**
     * Add Product
     *
     * @param Product $product
     */
    public function addProduct(Product $product)
    {
        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->products->contains($product)) {
            $this->products->add($product);
        }
    }
    /**
     * Add Collection Product
     *
     * @param Products $products
     */
    public function setProducts($products)
    {
        if ($products instanceof ArrayCollection || is_array($products)) {
            foreach ($product as $products) {
                $this->addProduit($product);
            }
        } elseif ($products instanceof Images) {
            $this->addProduit($products);
        } else {
            throw new Exception("$items must be an instance of Produit or ArrayCollection");
        }
    }
    /**
     * Get ArrayCollection
     *
     * @return ArrayCollection $produits
     */
    public function getImages()
    {
        return $this->images;
    }




}
