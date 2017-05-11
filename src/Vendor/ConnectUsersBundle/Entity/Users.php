<?php

namespace Vendor\ConnectUsersBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
/** @ORM\MappedSuperclass */
abstract class Users implements UserInterface,\Serializable
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

      /**
     * @var string
     *
     * @ORM\Column(name="tokenresetpass", type="string", length=255,nullable=true)
     */
    private $tokenResetPass;

    /**
     * @var DateTime
     * @Assert\DateTime()
     * @ORM\Column(name="limitedateresetpass", type="datetime",nullable=true)
     */
    private $limiteDateResetPass;



    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=80)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;


   


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Users
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Users
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
 
    public function getSalt(){
        return null;
     }
    
    public function getUsername(){
            return $this->email;
     }
    public function eraseCredentials(){}
        // serialize 
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->name,
            $this->firstname
        ));
    }
     // unserialize
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->name,
            $this->firsname
        ) = unserialize($serialized);
    }
  /**
     * Set tokenResetPass
     *
     * @param string $tokenResetPass
     *
     * @return PasswordReset
     */
    public function setTokenResetPass($tokenResetPass)
    {
        $this->tokenResetPass = $tokenResetPass;

        return $this;
    }

    /**
     * Get tokenResetPass
     *
     * @return string
     */
    public function getTokenResetPass()
    {
        return $this->tokenResetPass;
    }

    /**
     * Set limiteDateResetPass
     *
     * @param \DateTime $limiteDateResetPass
     *
     * @return U
     */
    public function setLimiteDateResetPass($limiteDateResetPass)
    {
        $this->limiteDateResetPass = $limiteDateResetPass;

        return $this;
    }

    /**
     * Get limiteDateResetPass
     *
     * @return \DateTime
     */
    public function getLimiteDateResetPass()
    {
        return $this->limiteDateResetPass;
    }


    public function getRoles(){
        
    }
}
