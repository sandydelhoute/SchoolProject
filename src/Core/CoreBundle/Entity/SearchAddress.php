<?php

namespace Core\CoreBundle\Entity;

class SearchAddress
{
    protected $address;

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }
}