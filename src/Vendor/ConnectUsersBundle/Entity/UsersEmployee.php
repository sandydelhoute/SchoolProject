<?php

namespace Vendor\ConnectUsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * UsersEmployee
 *
 * @ORM\Table(name="users_employee")
 * @ORM\Entity(repositoryClass="Vendor\ConnectUsersBundle\Repository\UsersEmployeeRepository")
 */
class UsersEmployee extends Users
{

    private $roles=array();


    public function getRoles(){
        return array('ROLE_USER');
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
     * @ORM\Column(name="numbersocial", type="string", length=255)
     */
    private $numbersocial;


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
    public function setNumbersocial($numbersocial)
    {
        $this->numbersocial = $numbersocial;

        return $this;
    }

    /**
     * Get numbersocial
     *
     * @return string
     */
    public function getNumbersocial()
    {
        return $this->numbersocial;
    }
 /*   public function getRoles(){
        return $this->array($status);
     }
*/
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
