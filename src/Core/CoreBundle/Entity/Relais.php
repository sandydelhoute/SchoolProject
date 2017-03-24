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

  public function __construct() {
    $this->coordonnes = new ArrayCollection();
}

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="Opening", mappedBy="relais")
     */
    private $id;

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
     * @var coordonnes
     *
     * @ORM\ManyToOne(targetEntity="Coordonne", inversedBy="id")
     * @ORM\JoinColumn(name="coodonne_relais", referencedColumnName="id")
     */
    private $coordonnes;




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
     * Add coordonne
     *
     * @param \Core\CoreBundle\Entity\Coodonne $coordonne
     *
     * @return Relais
     */
    public function addCoordonne(\Core\CoreBundle\Entity\Coodonne $coordonne)
    {
        $this->coordonnes[] = $coordonne;

        return $this;
    }

    /**
     * Remove coordonne
     *
     * @param \Core\CoreBundle\Entity\Coodonne $coordonne
     */
    public function removeCoordonne(\Core\CoreBundle\Entity\Coodonne $coordonne)
    {
        $this->coordonnes->removeElement($coordonne);
    }

    /**
     * Get coordonnes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCoordonnes()
    {
        return $this->coordonnes;
    }
}
