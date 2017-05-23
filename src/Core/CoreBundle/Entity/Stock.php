<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Stock
 *
 * @ORM\Table(name="stock")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\StockRepository")
 */
class Stock
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
     * @Groups({"product"})
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="Product",inversedBy="stock")
     * @ORM\JoinColumn(name="product_id",referencedColumnName="id")
     * @ORM\joinColumn(nullable=true)
     */
    private $product;
    

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Relais",inversedBy="stock")
     * @ORM\JoinColumn(name="relais_id",referencedColumnName="id")
     */
    private $relais;


    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Menu",inversedBy="stock")
     * @ORM\JoinColumn(name="menu_id",referencedColumnName="id")
     * @ORM\joinColumn(nullable=true)
     */
    private $menu;
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
     * @return Stock
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
     * Set product
     *
     * @param \Core\CoreBundle\Entity\Product $product
     *
     * @return Stock
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
     * Set relais
     *
     * @param \Core\CoreBundle\Entity\Relais $relais
     *
     * @return Stock
     */
    public function setRelais(\Core\CoreBundle\Entity\Relais $relais = null)
    {
        $this->relais = $relais;

        return $this;
    }

    /**
     * Get relais
     *
     * @return \Core\CoreBundle\Entity\Relais
     */
    public function getRelais()
    {
        return $this->relais;
    }

    /**
     * Set menu
     *
     * @param \Core\CoreBundle\Entity\Menu $menu
     *
     * @return Stock
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
}
