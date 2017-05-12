<?php

namespace Vendor\ConnectUsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * 
 * @ORM\Table(name="users_web")
 * @ORM\Entity(repositoryClass="Vendor\ConnectUsersBundle\Repository\UsersWebRepository")
 */
class UsersWeb extends Users
{

    public function __construct(){

        $this->cashBalance=0;
        $this->rewardPoints=0;
        $this->order = new ArrayCollection();

    }



    /**
     * @var bigint
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Core\CoreBundle\Entity\OrderClient",mappedBy="users",cascade={"persist"}))
     */
    private $order;

    /**
     * @var float
     *
     * @ORM\Column(name="cashBalance", type="float")
     */
    private $cashBalance;

    /**
     * @var int
     *
     * @ORM\Column(name="rewardPoints", type="integer")
     */
    private $rewardPoints;


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
     * Set cashBalance
     *
     * @param float $cashBalance
     *
     * @return UsersWeb
     */
    public function setCashBalance($cashBalance)
    {
        $this->cashBalance = $cashBalance;

        return $this;
    }

    /**
     * Get cashBalance
     *
     * @return float
     */
    public function getCashBalance()
    {
        return $this->cashBalance;
    }

    /**
     * Set rewardPoints
     *
     * @param integer $rewardPoints
     *
     * @return UsersWeb
     */
    public function setRewardPoints($rewardPoints)
    {
        $this->rewardPoints = $rewardPoints;

        return $this;
    }

    /**
     * Get rewardPoints
     *
     * @return int
     */
    public function getRewardPoints()
    {
        return $this->rewardPoints;
    }

   public function getRoles(){
        return array('ROLE_USER');
     }



    /**
     * Add order
     *
     * @param \Core\CoreBundle\Entity\OrderClient $order
     *
     * @return UsersWeb
     */
    public function addOrder(\Core\CoreBundle\Entity\OrderClient $order)
    {
        $this->order[] = $order;

        return $this;
    }

    /**
     * Remove order
     *
     * @param \Core\CoreBundle\Entity\OrderClient $order
     */
    public function removeOrder(\Core\CoreBundle\Entity\OrderClient $order)
    {
        $this->order->removeElement($order);
    }

    /**
     * Get order
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrder()
    {
        return $this->order;
    }
}
