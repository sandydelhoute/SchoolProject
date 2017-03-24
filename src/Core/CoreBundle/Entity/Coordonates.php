<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(name="complement", type="string", length=255)
     */
    private $complement;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
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
     * Set complement
     *
     * @param string $complement
     *
     * @return Coordonee
     */
    public function setComplement($complement)
    {
        $this->complement = $complement;

        return $this;
    }

    /**
     * Get complement
     *
     * @return string
     */
    public function getComplement()
    {
        return $this->complement;
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
}

