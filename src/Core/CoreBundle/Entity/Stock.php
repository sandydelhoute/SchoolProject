<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Product",inversedBy="stock")
     * @ORM\JoinColumn(name="product_id",referencedColumnName="id")
     */
    private $product;
    

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Relais",inversedBy="stock")
     * @ORM\JoinColumn(name="relais_id",referencedColumnName="id")
     */
    private $relais;
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
}
