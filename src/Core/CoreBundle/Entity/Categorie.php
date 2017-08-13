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
    public function __toString() {
    return $this->name;
    }

    public function __construct(){
    }
    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="categories")
     * @ORM\JoinTable(name="product_categrie")
     */
    private $product;

   

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
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id",onDelete="CASCADE")
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
     * Add product
     *
     * @param \Core\CoreBundle\Entity\Product $product
     *
     * @return Categorie
     */
    public function addProduct(\Core\CoreBundle\Entity\Product $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \Core\CoreBundle\Entity\Product $product
     */
    public function removeProduct(\Core\CoreBundle\Entity\Product $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduct()
    {
        return $this->product;
    }
}
