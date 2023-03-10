<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Allergene
 *
 * @ORM\Table(name="allergene")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\AllergeneRepository")
 */
class Allergene
{


public function __toString() {
    return $this->name;
}
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"product","allergene"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     * @Groups({"product","allergene"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text",nullable = true)
     * @Groups({"allergene"})
    */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Product", mappedBy="allergenes")
     * @ORM\JoinTable(name="product_allergene")
     */
    private $product;
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
     * @return Allergene
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
     * @return Allergene
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
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add product
     *
     * @param \Core\CoreBundle\Entity\Product $product
     *
     * @return Allergene
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
