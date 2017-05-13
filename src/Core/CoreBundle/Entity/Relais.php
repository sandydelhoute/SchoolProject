<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relais
 *
 * @ORM\Table(name="relais")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\RelaisRepository")
 */
class Relais
{
public function __toString() {
    return "Relais";
}
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Opening", inversedBy="relais")
     * @ORM\JoinColumn(name="opening_id", referencedColumnName="id")
     */     
    private $opening;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;


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
     * @return Relais
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
     * Set name
     *
     * @param string $name
     *
     * @return Relais
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
     * Set opening
     *
     * @param \Core\CoreBundle\Entity\Relais $opening
     *
     * @return Relais
     */
    public function setOpening(\Core\CoreBundle\Entity\Relais $opening = null)
    {
        $this->opening = $opening;

        return $this;
    }

    /**
     * Get opening
     *
     * @return \Core\CoreBundle\Entity\Relais
     */
    public function getOpening()
    {
        return $this->opening;
    }
}
