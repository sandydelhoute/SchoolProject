<?php

namespace Vendor\ConnectUsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * UsersWeb
 *
 * @ORM\Table(name="users_web")
 * @ORM\Entity(repositoryClass="Vendor\ConnectUsersBundle\Repository\UsersWebRepository")
 */
class UsersWeb
{
    /*
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */


    /**
     * @var bigint
     * @ORM\Id
     * @ORM\OneToOne(targetEntity="Vendor\ConnectUsersBundle\Entity\Users")
     * @ORM\JoinColumn(name="id", referencedColumnName="id", nullable=false)
     */
    
    private $id;

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
}
