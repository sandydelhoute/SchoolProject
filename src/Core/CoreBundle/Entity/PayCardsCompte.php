<?php

namespace Core\CoreBundle\Entity;

class PayCardsCompte
{
    protected $name;

    protected $numberCards;

    protected $dateExpiration;

    protected $solde;

    protected $securityCode;



    public function getSolde()
    {
        return $this->solde;
    }

    public function setSolde($solde)
    {
        $this->solde = $solde;
    }

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