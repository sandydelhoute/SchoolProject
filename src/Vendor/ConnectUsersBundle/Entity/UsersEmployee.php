<?php

namespace Vendor\ConnectUsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JsonSerializable;
/**
 * 
 * @ORM\Table(name="users_employe")
 * @ORM\Entity(repositoryClass="Vendor\ConnectUsersBundle\Repository\UsersEmployeeRepository")
 */
class UsersEmployee extends Users
{

   
    /**
     * @var bigint
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function getRoles(){
        return array('ROLE_'.$this->status->getName());
     }


    /**
      *
      * @ORM\ManyToOne(targetEntity="Status")
      * @ORM\JoinColumn(name="status", referencedColumnName="id")
      */
    private $status;

    /**
     * @var \Date
     *
     * @ORM\Column(name="birthdate", type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="hiredate", type="date")
     * @Assert\NotBlank()
     * @Assert\Date()
     */
    private $hiredate;


    

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return UsersEmployee
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set numbersocial
     *
     * @param string $numbersocial
     *
     * @return UsersEmployee
     */
    public function setHiredate($hiredate)
    {
        $this->hiredate = $hiredate;

        return $this;
    }

    /**
     * Get numbersocial
     *
     * @return string
     */
    public function getHiredate()
    {
        return $this->hiredate;
    }


    /**
     * Set status
     *
     * @param \Vendor\ConnectUsersBundle\Entity\Status $status
     *
     * @return UsersEmployee
     */
    public function setStatus(\Vendor\ConnectUsersBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Vendor\ConnectUsersBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

}
