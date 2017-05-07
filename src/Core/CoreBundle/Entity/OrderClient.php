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
     * @var \DateTime
     *
     * @ORM\Column(name="datePurchase", type="datetime")
     */
    private $datePurchase;


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
}

