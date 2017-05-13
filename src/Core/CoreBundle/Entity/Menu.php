<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Menu
 *
 * @ORM\Table(name="menu")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\MenuRepository")
 */
class Menu
{

    /**
     * Constructor
     */
  public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->categories = new ArrayCollection();
        $this->product = new ArrayCollection();
    }


    /**
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="menu")
     * @ORM\JoinTable(name="menu_product")
     */
    private $product;

    /**
     * @ORM\ManyToMany(targetEntity="Images", inversedBy="menu")
     */
    private $images;


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
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

     /**
     * @var string
     *
     * @ORM\Column(name="composition", type="text")
     */
    private $composition;


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
     * @return Menu
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
     * Set prix
     *
     * @param float $prix
     *
     * @return Menu
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
     * Set active
     *
     * @param boolean $active
     *
     * @return Menu
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Menu
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
     * Set composition
     *
     * @param string $composition
     *
     * @return Menu
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
     * Add image
     *
     * @param \Core\CoreBundle\Entity\Images $image
     *
     * @return Menu
     */
    public function addImage(\Core\CoreBundle\Entity\Images $image)
    {
        $image->addMenu($this); // synchronously updating inverse side
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
     * Add product
     *
     * @param \Core\CoreBundle\Entity\Product $product
     *
     * @return Menu
     */
    public function addProduct(\Core\CoreBundle\Entity\Product $product)
    {
        $product->addMenu($this);
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
