<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\ProductRepository")
 */
class Product
{

  public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->allergenes = new ArrayCollection();
        $this->stock = new ArrayCollection();
        }
    /**
     * @ORM\ManyToMany(targetEntity="Categorie", inversedBy="product",cascade={"persist"})
     */
    private $categories;
    /**
     * @Groups({"product"})
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="product",cascade={"persist"})
     */
    private $stock;

    /**
     * @Groups({"product"})
     * @ORM\ManyToMany(targetEntity="Allergene", inversedBy="product")
     */
    private $allergenes;

    /**
     * @ORM\ManyToMany(targetEntity="Images", inversedBy="product",cascade={"persist"})
     * @Groups({"product"})
     */
    private $images;
    /**
     * @ORM\ManyToOne(targetEntity="Provider")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id")
     */
    private $provider;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="LineOrder", mappedBy="product")
     * @Groups({"product"})
     */
    private $id;

    /**
     * @var string
     *     
     * @Groups({"product"})
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @Groups({"product"})
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @Groups({"product"})
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;


    /**
     * @var string
     *
     * @ORM\Column(name="composition", type="text")
     */
    private $composition;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

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
     * @return Product
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
     * Set description
     *
     * @param string $description
     *
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Product
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set composition
     *
     * @param string $composition
     *
     * @return Product
     */
    public function setComposition($composition)
    {
        $this->composition = $composition;

        return $this;
    }

    /**
     * Get composition
     *
     * @return string
     */
    public function getComposition()
    {
        return $this->composition;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Product
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Add allergene
     *
     * @param \Core\CoreBundle\Entity\Allergene $allergene
     *
     * @return Product
     */
    public function addAllergene(\Core\CoreBundle\Entity\Allergene $allergene)
    {
        $allergene->addProduct($this); // synchronously updating inverse side
        $this->allergenes[] = $allergene;

        return $this;
    }

    /**
     * Remove allergene
     *
     * @param \Core\CoreBundle\Entity\Allergene $allergene
     */
    public function removeAllergene(\Core\CoreBundle\Entity\Allergene $allergene)
    {
        $this->allergenes->removeElement($allergene);
    }

    /**
     * Get allergenes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAllergenes()
    {
        return $this->allergenes;
    }

    

    /**
     * Add image
     *
     * @param \Core\CoreBundle\Entity\Images $image
     *
     * @return Product
     */
    public function addImage(\Core\CoreBundle\Entity\Images $image)
    {
        $image->addProduct($this); // synchronously updating inverse side
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Core\CoreBundle\Entity\Images $image
     */
    public function removeImage(\Core\CoreBundle\Entity\Images $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Add category
     *
     * @param \Core\CoreBundle\Entity\Categorie $category
     *
     * @return Product
     */
    public function addCategory(\Core\CoreBundle\Entity\Categorie $category)
    {
        $category->addProduct($this);// synchronously updating inverse side
        $this->categories[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Core\CoreBundle\Entity\Categorie $category
     */
    public function removeCategory(\Core\CoreBundle\Entity\Categorie $category)
    {
        $this->categories->removeElement($category);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategories()
    {
        return $this->categories;
    }


    /**
     * Set provider
     *
     * @param \Core\CoreBundle\Entity\Provider $provider
     *
     * @return Product
     */
    public function setProvider(\Core\CoreBundle\Entity\Provider $provider = null)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \Core\CoreBundle\Entity\Provider
     */
    public function getProvider()
    {
        return $this->provider;
    }


    /**
     * Add stock
     *
     * @param \Core\CoreBundle\Entity\Stock $stock
     *
     * @return Product
     */
    public function addStock(\Core\CoreBundle\Entity\Stock $stock)
    {
        $this->stock[] = $stock;

        return $this;
    }

    /**
     * Remove stock
     *
     * @param \Core\CoreBundle\Entity\Stock $stock
     */
    public function removeStock(\Core\CoreBundle\Entity\Stock $stock)
    {
        $this->stock->removeElement($stock);
    }

    /**
     * Get stock
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStock()
    {
        return $this->stock;
    }
    public function __toString(){
        return "product";
    }
}
