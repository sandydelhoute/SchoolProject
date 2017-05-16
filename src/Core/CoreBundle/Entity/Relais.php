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
     * @ORM\OneToMany(targetEntity="Stock", mappedBy="relais")
     */
    private $stock;

    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Coordonates",cascade={"persist"}))
     * @ORM\JoinColumn(name="Coordonates_id",referencedColumnName="id")
     */
    private $coordonates;

    /**
     * @ORM\ManyToOne(targetEntity="Opening", inversedBy="relais")
     * @ORM\JoinColumn(name="opening_id", referencedColumnName="id")
     */     
    private $opening;


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
     * Set coordonates
     *
     * @param \Core\CoreBundle\Entity\Coordonates $coordonates
     *
     * @return Relais
     */
    public function setCoordonates(\Core\CoreBundle\Entity\Coordonates $coordonates = null)
    {
        $this->coordonates = $coordonates;

        return $this;
    }

    /**
     * Get coordonates
     *
     * @return \Core\CoreBundle\Entity\Coordonates
     */
    public function getCoordonates()
    {
        return $this->coordonates;
    }

    /**
     * Set opening
     *
     * @param \Core\CoreBundle\Entity\Opening $opening
     *
     * @return Relais
     */
    public function setOpening(\Core\CoreBundle\Entity\Opening $opening = null)
    {
        $this->opening = $opening;

        return $this;
    }

    /**
     * Get opening
     *
     * @return \Core\CoreBundle\Entity\Opening
     */
    public function getOpening()
    {
        return $this->opening;
    }
}
