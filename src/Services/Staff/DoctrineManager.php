<?php

namespace MMC\FestivalBundle\Services\Staff;

use Doctrine\ORM\EntityManager;
use MMC\FestivalBundle\Entity\ContactStaff;

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
