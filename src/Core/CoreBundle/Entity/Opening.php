<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
/**
 * Time
 *
 * @ORM\Table(name="opening")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\OpeningRepository")
 */
class Opening
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
     * @var \String
     *
     * @ORM\Column(type="string") 
     */
    private $dayopen;

    /**
     * @var \Time
     *
     * @ORM\Column(name="timeopen", type="time")
     */
    private $timeopen;

    /**
     * @var \Time
     *
     * @ORM\Column(name="timeclose", type="time")
     */
    private $timeclose;

    /**
     * @var \Time
     *
     * @ORM\Column(name="timedelivry", type="time")
     */
    private $timedelivry;

    /**
     * @var \Time
     *
     * @ORM\Column(name="timelimitshop", type="time")
     */
    private $timelimitshop;


    /**
     * @var \Relais
     *
     * @ORM\OneToMany(targetEntity="Core\CoreBundle\Entity\Relais", 
     mappedBy="opening")
     */
    private $relais;


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
     * Set dayopen
     *
     * @param \DateTime $dayopen
     *
     * @return Time
     */
    public function setDayopen($dayopen)
    {
        $this->dayopen = $dayopen;

        return $this;
    }

    /**
     * Get dayopen
     *
     * @return \DateTime
     */
    public function getDayopen()
    {
        return $this->dayopen;
    }

    /**
     * Set timeopen
     *
     * @param \DateTime $timeopen
     *
     * @return Time
     */
    public function setTimeopen($timeopen)
    {
        $this->timeopen = $timeopen;

        return $this;
    }

    /**
     * Get timeopen
     *
     * @return \DateTime
     */
    public function getTimeopen()
    {
        return $this->timeopen;
    }

    /**
     * Set timeclose
     *
     * @param \DateTime $timeclose
     *
     * @return Time
     */
    public function setTimeclose($timeclose)
    {
        $this->timeclose = $timeclose;

        return $this;
    }

    /**
     * Get timeclose
     *
     * @return \DateTime
     */
    public function getTimeclose()
    {
        return $this->timeclose;
    }

    /**
     * Set timedelivry
     *
     * @param string $timedelivry
     *
     * @return Time
     */
    public function setTimedelivry($timedelivry)
    {
        $this->timedelivry = $timedelivry;

        return $this;
    }

    /**
     * Get timedelivry
     *
     * @return string
     */
    public function getTimedelivry()
    {
        return $this->timedelivry;
    }

    /**
     * Set timelimitshop
     *
     * @param \DateTime $timelimitshop
     *
     * @return Time
     */
    public function setTimelimitshop($timelimitshop)
    {
        $this->timelimitshop = $timelimitshop;

        return $this;
    }

    /**
     * Get timelimitshop
     *
     * @return \DateTime
     */
    public function getTimelimitshop()
    {
        return $this->timelimitshop;
    }

    /**
     * Set relais
     *
     * @param \Core\CoreBundle\Entity\Relais $relais
     *
     * @return Opening
     */
    public function setRelais(\Core\CoreBundle\Entity\Relais $relais = null)
    {
        $this->relais = $relais;

        return $this;
    }

    /**
     * Get relais
     *
     * @return \Core\CoreBundle\Entity\Relais
     */
    public function getRelais()
    {
        return $this->relais;
    }
}
