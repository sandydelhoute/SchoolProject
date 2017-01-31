<?php

namespace Adress\AdressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * coordinates
 *
 * @ORM\Table(name="coordinates")
 * @ORM\Entity(repositoryClass="Adress\AdressBundle\Repository\coordinatesRepository")
 */
class Coordinates
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
      *
      * @ORM\ManyToOne(targetEntity="City")
      * @ORM\JoinColumn(name="city", referencedColumnName="id")
      */
    private $city;

    /**
      *
      * @ORM\ManyToOne(targetEntity="StreetType")
      * @ORM\JoinColumn(name="streetType", referencedColumnName="id")
      */
    private $streeType;
    /**
     * @var string
     *
     * @ORM\Column(name="complements", type="text", nullable=true)
     */
    private $complements;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=25, nullable=true)
     */
    private $phone;


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
     * Set complements
     *
     * @param string $complements
     *
     * @return coordinates
     */
    public function setComplements($complements)
    {
        $this->complements = $complements;

        return $this;
    }

    /**
     * Get complements
     *
     * @return string
     */
    public function getComplements()
    {
        return $this->complements;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return coordinates
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
}

