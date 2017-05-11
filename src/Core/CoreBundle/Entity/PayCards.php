<?php

namespace Core\CoreBundle\Entity;

class PayCards
{
    protected $name;

    protected $numberCards;

    protected $monthExpiration;

    protected $yearExpiration;

    protected $securityCode;

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getNumberCards()
    {
        return $this->numberCards;
    }

    public function setNumberCards($numberCards)
    {
        $this->numberCards = $numberCards;
    }
    public function getMonthExpiration()
    {
        return $this->monthExpiration;
    }

    public function setMonthExpiration($monthExpiration)
    {
        $this->monthExpiration = $monthExpiration;
    }

    public function getYearExpiration()
    {
        return $this->yearExpiration;
    }

    public function setYearExpiration($yearExpiration)
    {
        $this->yearExpiration = $yearExpiration;
    }

    public function getSecurityCode()
    {
        return $this->securityCode;
    }

    public function setSecurityCode($securityCode)
    {
        $this->body = $securityCode;
    }
}