<?php

namespace Core\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Addres
 *
 * @ORM\Table(name="addres")
 * @ORM\Entity(repositoryClass="Core\CoreBundle\Repository\AddresRepository")
 */
class Addres
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

