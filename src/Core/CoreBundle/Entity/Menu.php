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
        $this->products = new ArrayCollection();

    }


    /**
     * @var ArrayCollection product $products
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="product", inversedBy="menu", cascade={"persist", "merge"})
     * @ORM\JoinTable(name="menu_produit",
     *   joinColumns={@ORM\JoinColumn(name="id_menu", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="id_produit", referencedColumnName="id")}
     * )
     */
    private $products;

    /**
     * @var ArrayCollection images $images
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Images", inversedBy="menu", cascade={"persist", "merge"})
     * @ORM\JoinTable(name="images_menu",
     *   joinColumns={@ORM\JoinColumn(name="id_menu", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="id_images", referencedColumnName="id")}
     * )
     */
    private $images;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="LineOrder", mappedBy="menu")
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
     * Add product
     *
     * @param \Core\CoreBundle\Entity\product $product
     *
     * @return Menu
     */
    public function addProduct(\Core\CoreBundle\Entity\product $product)
    {
        $this->products[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \Core\CoreBundle\Entity\product $product
     */
    public function removeProduct(\Core\CoreBundle\Entity\product $product)
    {
        $this->products->removeElement($product);
    }

    /**
     * Get products
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add image
     *
     * @param \Core\CoreBundle\Entity\images $image
     *
     * @return Menu
     */
    public function addImage(\Core\CoreBundle\Entity\images $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \Core\CoreBundle\Entity\images $image
     */
    public function removeImage(\Core\CoreBundle\Entity\images $image)
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
}
