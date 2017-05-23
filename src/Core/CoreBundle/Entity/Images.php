<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;

/**
 * Images
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\imagesRepository")
 */
class Images
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"product"})
     */
    private $id;
    /**
     * @ORM\ManyToMany(targetEntity="Posts", mappedBy="images")
     * @ORM\JoinTable(name="posts_image")
     */
    private $posts;
    /**
     * @ORM\ManyToMany(targetEntity="Menu", mappedBy="images")
     * @ORM\JoinTable(name="menu_images")
     */
    private $menu;

    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="images")
     * @ORM\JoinTable(name="product_image")
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=255,unique=true)
     * @Groups({"product"})
     */
    private $path;

     /**
     * 
     *
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File( mimeTypes = {"application/png", "application/jpg", "application/jpeg","application/svg"})
     */
    private $file;


    /**
     * @var string
     *
     * @Groups({"product"})
     * @ORM\Column(name="alt", type="string", length=255, unique=true)
     */
    private $alt;


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
     * Set path
     *
     * @param string $path
     *
     * @return images
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }




    /**
     * Set alt
     *
     * @param string $alt
     *
     * @return images
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set file
     *
     * @param string $file
     *
     * @return Images
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->menu = new \Doctrine\Common\Collections\ArrayCollection();
    }



    /**
     * Add menu
     *
     * @param \Core\CoreBundle\Entity\Menu $menu
     *
     * @return Images
     */
    public function addMenu(\Core\CoreBundle\Entity\Menu $menu)
    {
        $this->menu[] = $menu;

        return $this;
    }

    /**
     * Remove menu
     *
     * @param \Core\CoreBundle\Entity\Menu $menu
     */
    public function removeMenu(\Core\CoreBundle\Entity\Menu $menu)
    {
        $this->menu->removeElement($menu);
    }

    /**
     * Get menu
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Add product
     *
     * @param \Core\CoreBundle\Entity\Product $product
     *
     * @return Images
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

    /**
     * Add post
     *
     * @param \Core\CoreBundle\Entity\Posts $post
     *
     * @return Images
     */
    public function addPost(\Core\CoreBundle\Entity\Posts $post)
    {
        $this->posts[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \Core\CoreBundle\Entity\Posts $post
     */
    public function removePost(\Core\CoreBundle\Entity\Posts $post)
    {
        $this->posts->removeElement($post);
    }

    /**
     * Get posts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPosts()
    {
        return $this->posts;
    }
}
