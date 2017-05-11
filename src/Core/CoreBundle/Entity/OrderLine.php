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
     * @ORM\ManyToOne(targetEntity="OrderCLient",inversedBy="order")
     * @ORM\JoinColumn(name="order_id",referencedColumnName="id")
     */
    private $orderClient;


    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="prixEntier", type="float")
     */
    private $prix;

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
     * Set prix
     *
     * @param integer $prix
     *
     * @return OrderLine
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

    /**
     * Set orderClient
     *
     * @param \Core\CoreBundle\Entity\OrderCLient $orderClient
     *
     * @return OrderLine
     */
    public function setOrderClient(\Core\CoreBundle\Entity\OrderCLient $orderClient = null)
    {
        $this->orderClient = $orderClient;

        return $this;
    }

    /**
     * Get orderClient
     *
     * @return \Core\CoreBundle\Entity\OrderCLient
     */
    public function getOrderClient()
    {
        return $this->orderClient;
    }
}
