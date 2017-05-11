<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Posts
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\PostsRepository")
 */
class Posts
{


      public function __construct()
    {
        $this->images = new ArrayCollection();
    }

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;



    /**
     * @var text
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var datetime
     * @Assert\DateTime()
     *
     * @ORM\Column(name="datetime",type="datetime")
     */
    private $datepublish;

  /**
     * @var ArrayCollection images $images
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Core\CoreBundle\Entity\Images", inversedBy="posts", cascade={"persist", "merge"})
     * @ORM\JoinTable(name="images_posts",
     *   joinColumns={@ORM\JoinColumn(name="id_posts", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="id_images", referencedColumnName="id")}
     * )
     */
  private $images;

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
     * Set title
     *
     * @param string $title
     *
     * @return Posts
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Remove Image
     *
     * @param Images $image
     */

    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
        
    }

    /**
     * Add Image
     *
     * @param Images $image
     */
     public function addImage(Image $image)
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
     * Set content
     *
     * @param string $content
     *
     * @return Posts
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set datepublish
     *
     * @param \DateTime $datepublish
     *
     * @return Posts
     */
    public function setDatepublish($datepublish)
    {
        $this->datepublish = $datepublish;

        return $this;
    }

    /**
     * Get datepublish
     *
     * @return \DateTime
     */
    public function getDatepublish()
    {
        return $this->datepublish;
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