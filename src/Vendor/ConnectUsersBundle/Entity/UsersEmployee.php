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


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime")
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
}

