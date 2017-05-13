<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * OrderClient
 *
 * @ORM\Table(name="order_client")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\OrderClientRepository")
 */
class OrderClient
{

    public function __toString(){
        return "OrderClient";
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
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Vendor\ConnectUsersBundle\Entity\UsersWeb")
     * @ORM\JoinColumn(name="users_id",referencedColumnName="id")
     */
    private $users;

    /**
     * @ORM\ManyToOne(targetEntity="Relais")
     * @ORM\JoinColumn(name="relais_id",referencedColumnName="id")
     */
    private $relais;

    /**
     * @ORM\ManyToOne(targetEntity="Payement")
     * @ORM\JoinColumn(name="payement_id",referencedColumnName="id")
     */
    private $payement;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datePurchase", type="datetime")
     */
    private $datePurchase;

    /**
     *
     * @ORM\OneToMany(targetEntity="OrderLine", mappedBy="orderClient",cascade={"persist"})
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

    /**
     * Set users
     *
     * @param \Vendor\ConnectUsersBundle\Entity\UsersWeb $users
     *
     * @return OrderClient
     */
    public function setUsers(\Vendor\ConnectUsersBundle\Entity\UsersWeb $users = null)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get users
     *
     * @return \Vendor\ConnectUsersBundle\Entity\UsersWeb
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set payement
     *
     * @param \Core\CoreBundle\Entity\Payement $payement
     *
     * @return OrderClient
     */
    public function setPayement(\Core\CoreBundle\Entity\Payement $payement = null)
    {
        $this->payement = $payement;

        return $this;
    }

    /**
     * Get payement
     *
     * @return \Core\CoreBundle\Entity\Payement
     */
    public function getPayement()
    {
        return $this->payement;
    }

    /**
     * Set relais
     *
     * @param \Core\CoreBundle\Entity\Relais $relais
     *
     * @return OrderClient
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
