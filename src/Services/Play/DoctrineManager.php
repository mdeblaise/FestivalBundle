<?php

namespace MMC\FestivalBundle\Services\Play;

use Doctrine\ORM\EntityManager;
use MMC\FestivalBundle\Entity\Play;

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
        $play = new Play();

        $play->setFirstname($data->getFirstname())
            ->setLastname($data->getLastname())
            ->setEmail($data->getEmail())
            ->setPhone($data->getPhone())
            ->setDepartmentNumber($data->getDepartmentNumber())
            ->setReceiveInformation($data->getReceiveInformation())
        ;

        $this->em->persist($play);

        $this->em->flush();

        return $play;
    }
}
