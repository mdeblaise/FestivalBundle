<?php

namespace MMC\FestivalBundle\Services\Staff;

use Doctrine\ORM\EntityManager;

class DoctrineManager
{
    protected $em;

    public function __construct(
        EntityManager $em
    ) {
        $this->em = $em;
    }

    public function create($contactStaff)
    {
        $this->em->persist($contactStaff);

        $this->em->flush();

        return $contactStaff;
    }
}
