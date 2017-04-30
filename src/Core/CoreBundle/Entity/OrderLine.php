<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderLine
 *
 * @ORM\Table(name="order_line")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\OrderLineRepository")
 */
class OrderLine
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var int
     *
     * @ORM\Column(name="prixEntier", type="integer")
     */
    private $prixEntier;

    /**
     * @var int
     *
     * @ORM\Column(name="prixCentime", type="integer")
     */
    private $prixCentime;


    /**
     * @ORM\ManyToOne(targetEntity="Menu", inversedBy="id")
     * @ORM\JoinColumn(nullable=true)
     */
    private $menu;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="id")
     * @ORM\JoinColumn(nullable=true)
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return OrderLine
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set prixEntier
     *
     * @param integer $prixEntier
     *
     * @return OrderLine
     */
    public function setPrixEntier($prixEntier)
    {
        $this->prixEntier = $prixEntier;

        return $this;
    }

    /**
     * Get prixEntier
     *
     * @return int
     */
    public function getPrixEntier()
    {
        return $this->prixEntier;
    }

    /**
     * Set prixCentime
     *
     * @param integer $prixCentime
     *
     * @return OrderLine
     */
    public function setPrixCentime($prixCentime)
    {
        $this->prixCentime = $prixCentime;

        return $this;
    }

    /**
     * Get prixCentime
     *
     * @return int
     */
    public function getPrixCentime()
    {
        return $this->prixCentime;
    }

    /**
     * Set menu
     *
     * @param \Core\CoreBundle\Entity\Menu $menu
     *
     * @return OrderLine
     */
    public function setMenu(\Core\CoreBundle\Entity\Menu $menu = null)
    {
        $this->menu = $menu;

        return $this;
    }

    /**
     * Get menu
     *
     * @return \Core\CoreBundle\Entity\Menu
     */
    public function getMenu()
    {
        return $this->menu;
    }

    /**
     * Set product
     *
     * @param \Core\CoreBundle\Entity\Product $product
     *
     * @return OrderLine
     */
    public function setProduct(\Core\CoreBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Core\CoreBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}
