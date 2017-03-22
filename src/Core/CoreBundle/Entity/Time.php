<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Time
 *
 * @ORM\Table(name="time")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\TimeRepository")
 */
class Time
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
     * @var \DateTime
     *
     * @ORM\Column(name="dayopen", type="date")
     */
    private $dayopen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeopen", type="time")
     */
    private $timeopen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timeclose", type="time")
     */
    private $timeclose;

    /**
     * @var string
     *
     * @ORM\Column(name="timedelivry", type="string", length=255)
     */
    private $timedelivry;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timelimitshop", type="time")
     */
    private $timelimitshop;


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
}

