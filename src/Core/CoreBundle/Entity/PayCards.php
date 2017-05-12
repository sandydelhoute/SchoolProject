<?php

namespace Core\CoreBundle\Entity;

class PayCards
{
    protected $name;

    protected $numberCards;

    protected $dateExpiration;


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
    public function getDateExpiration()
    {
        return $this->dateExpiration;
    }

    public function setDateExpiration($dateExpiration)
    {
        $this->dateExpiration = $dateExpiration;
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