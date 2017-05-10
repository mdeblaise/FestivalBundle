<?php

namespace MMC\FestivalBundle\Services\Exponent;

use Doctrine\ORM\EntityManager;

class DoctrineManager
{
    protected $em;

    public function __construct(
        EntityManager $em
    ) {
        $this->em = $em;
    }

    public function create($data)
    {
        $this->em->persist($data);

        $this->em->flush();

        return $data;
    }
}
