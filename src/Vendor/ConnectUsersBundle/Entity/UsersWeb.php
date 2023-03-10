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
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Core\CoreBundle\Entity\Coordonates")
     * @ORM\JoinColumn(name="coordonates_id",referencedColumnName="id",nullable=true)
     */
    private $address;


    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Core\CoreBundle\Entity\Relais")
     * @ORM\JoinColumn(name="relais_id",referencedColumnName="id",nullable=true)
     */
    private $relais;

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
    public function __toString(){
        return "UsersWeb";
    }


    /**
     * Set relais
     *
     * @param \Core\CoreBundle\Entity\Relais $relais
     *
     * @return UsersWeb
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
     * Set address
     *
     * @param \Core\CoreBundle\Entity\Coordonates $address
     *
     * @return UsersWeb
     */
    public function setAddress(\Core\CoreBundle\Entity\Coordonates $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \Core\CoreBundle\Entity\Coordonates
     */
    public function getAddress()
    {
        return $this->address;
    }
}
