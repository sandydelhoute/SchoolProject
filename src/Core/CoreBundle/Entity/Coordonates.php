<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Groups;

/**
 * Coordonee
 *
 * @ORM\Table(name="coordonates")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\CoordonatesRepository")
 */
class Coordonates
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="Relais", mappedBy="coodonnes")
     */
     
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="float")
     * @Groups({"relais"})
     */
    private $longitude;


    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="float")
     * @Groups({"relais"})
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255,nullable=true)
     */
    private $phone;


    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255,nullable=true)
     * @Groups({"relais"})
     */
    private $address;

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
     * Set phone
     *
     * @param string $phone
     *
     * @return Coordonee
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

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Coordonates
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Coordonates
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Coordonates
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
    public function __toString()
    {
        return "coordonates";
    }
}
