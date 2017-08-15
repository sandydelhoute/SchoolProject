<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Groups;


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
     * @Groups({"posts"})

     */
    private $id;

    /**
     * @var boolean
     * @orm\Column(name="homepage" , type="boolean",nullable=true)
     */
    private $homePage;
    

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Groups({"posts"})
     */
    private $title;



    /**
     * @var text
     *
     * @ORM\Column(name="content", type="text")
     * @Groups({"posts"})
     */
    private $content;

    /**
     * @var datetime
     * @Assert\DateTime()
     *
     * @ORM\Column(name="datetime",type="datetime")
     * @Groups({"posts"})
     */
    private $datepublish;

   /**
     * @ORM\ManyToMany(targetEntity="Images", inversedBy="posts")
     * @Groups({"posts"})
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
     * Add image
     *
     * @param \Core\CoreBundle\Entity\Images $image
     *
     * @return Posts
     */
    public function addImage(\Core\CoreBundle\Entity\Images $image)
    {
        $image->addPost($this); // synchronously updating inverse side
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
     * Set homePage
     *
     * @param boolean $homePage
     *
     * @return Posts
     */
    public function setHomePage($homePage)
    {
        $this->homePage = $homePage;

        return $this;
    }

    /**
     * Get homePage
     *
     * @return boolean
     */
    public function getHomePage()
    {
        return $this->homePage;
    }
}
