<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Groups;

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
        $this->stock = new ArrayCollection();
    }

    /**
     * @Groups({"menu"})
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="menu")
     */
    private $stock;

    /**
     * @Groups({"menu"})
     */
    private $total;

    /**
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="menu")
     * @ORM\JoinTable(name="menu_product")
     * @Groups({"menu"})
     */
    private $product;

    /**
     * @Groups({"menu"})
     * @ORM\ManyToMany(targetEntity="Images", inversedBy="menu")
     */
    private $images;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"menu"})
     */
    private $id;



    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Groups({"menu"})
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float")
     * @Groups({"menu"})
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
     * @Groups({"menu"})
     */
    private $description;

     /**
     * @var string
     *
     * @ORM\Column(name="composition", type="text")
     * @Groups({"menu"})
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

    /**
     * Add stock
     *
     * @param \Core\CoreBundle\Entity\Stock $stock
     *
     * @return Menu
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

    public function getTotal()
    {
        return $this->total;
    }
    
    public function setTotal($total)
    {
        return $this->total=$total;
    }

    public function totalPriceProduct(){
        $total=0;
        foreach ($product as $key => $value) {
         $total += $value->getPrix();   
        }
         $this->setTotal($total);
    }
}
