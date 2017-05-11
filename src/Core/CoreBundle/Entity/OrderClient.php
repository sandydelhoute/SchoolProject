<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * OrderClient
 *
 * @ORM\Table(name="order_client")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\OrderClientRepository")
 */
class OrderClient
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
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Vendor\ConnectUsersBundle\Entity\UsersWeb",inversedBy="id")
     * @ORM\JoinColumn(name="users_id",referencedColumnName="id")
     */
    private $users;

    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePurchase", type="datetime")
     */
    private $datePurchase;

    /**
     *
     * @ORM\OneToMany(targetEntity="OrderLine", mappedBy="orderClient")
     */
    private $orderLine;



    public function __construct() {
        $this->orderLine = new ArrayCollection();
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
     * Set datePurchase
     *
     * @param \DateTime $datePurchase
     *
     * @return OrderClient
     */
    public function setDatePurchase($datePurchase)
    {
        $this->datePurchase = $datePurchase;

        return $this;
    }

    /**
     * Get datePurchase
     *
     * @return \DateTime
     */
    public function getDatePurchase()
    {
        return $this->datePurchase;
    }

    /**
     * Add orderLine
     *
     * @param \Core\CoreBundle\Entity\OrderLine $orderLine
     *
     * @return OrderClient
     */
    public function addOrderLine(\Core\CoreBundle\Entity\OrderLine $orderLine)
    {
        $this->orderLine[] = $orderLine;

        return $this;
    }

    /**
     * Remove orderLine
     *
     * @param \Core\CoreBundle\Entity\OrderLine $orderLine
     */
    public function removeOrderLine(\Core\CoreBundle\Entity\OrderLine $orderLine)
    {
        $this->orderLine->removeElement($orderLine);
    }

    /**
     * Get orderLine
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderLine()
    {
        return $this->orderLine;
    }

}
