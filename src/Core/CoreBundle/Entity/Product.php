<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
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
        $this->providers = new ArrayCollection();
    }
  /**
     * @var ArrayCollection categorie $categories
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Core\CoreBundle\Entity\Categorie", inversedBy="product", cascade={"persist", "merge"})
     * @ORM\JoinTable(name="categorie_product",
     *   joinColumns={@ORM\JoinColumn(name="id_product", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="id_categorie", referencedColumnName="id")}
     * )
     */
    private $categories;



  /**
     * @var ArrayCollection allergenes $allergenes
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Core\CoreBundle\Entity\Allergene", inversedBy="product", cascade={"persist", "merge"})
     * @ORM\JoinTable(name="allergene_product",
     *   joinColumns={@ORM\JoinColumn(name="id_product", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="id_allergene", referencedColumnName="id")}
     * )
     */
    private $allergenes;


  /**
     * @var ArrayCollection images $images
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Core\CoreBundle\Entity\Images", inversedBy="product", cascade={"persist", "merge"})
     * @ORM\JoinTable(name="images_product",
     *   joinColumns={@ORM\JoinColumn(name="id_product", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="id_images", referencedColumnName="id")}
     * )
     */
    private $images;



    /** 
     * @ORM\ManyToOne(targetEntity="Provider", inversedBy="id")
     * @ORM\JoinColumn(name="product_provider", referencedColumnName="id")
     */

    private $providers;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="LineOrder", mappedBy="product")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
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
     * Remove Image
     *
     * @param Images $image
     */

 public function removeImage(Images $image)
    {
        $this->images->removeElement($image);
        
    }

    /**
     * Add Images
     *
     * @param Images $image
     */
    public function addImage(Images $image)
    {
        // Si l'objet fait déjà partie de la collection on ne l'ajoute pas
        if (!$this->images->contains($image)) {
            $this->images->add($image);
        }
    }
     /**
     * Add Collection Images
     *
     * @param Images $images
     */
    public function setImages($images)
    {
        if ($images instanceof ArrayCollection || is_array($images)) {
            foreach ($image as $images) {
                $this->addProduit($image);
            }
        } elseif ($images instanceof Images) {
            $this->addProduit($images);
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
     * Add category
     *
     * @param \Core\CoreBundle\Entity\Categorie $category
     *
     * @return Product
     */
    public function addCategory(\Core\CoreBundle\Entity\Categorie $category)
    {
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
     * Add allergene
     *
     * @param \Core\CoreBundle\Entity\Allergene $allergene
     *
     * @return Product
     */
    public function addAllergene(\Core\CoreBundle\Entity\Allergene $allergene)
    {
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
     * Set providers
     *
     * @param \Core\CoreBundle\Entity\Provider $providers
     *
     * @return Product
     */
    public function setProviders(\Core\CoreBundle\Entity\Provider $providers = null)
    {
        $this->providers = $providers;

        return $this;
    }

    /**
     * Get providers
     *
     * @return \Core\CoreBundle\Entity\Provider
     */
    public function getProviders()
    {
        return $this->providers;
    }
    public function toString(){
        
    }
}
