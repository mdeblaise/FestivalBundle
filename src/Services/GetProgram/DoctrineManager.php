<?php

namespace MMC\FestivalBundle\Services\GetProgram;

use Doctrine\ORM\EntityManager;
use MMC\FestivalBundle\Entity\GetProgram;

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
        $getProgram = new GetProgram();

        $getProgram->setCivility($data->getCivility())
            ->setFirstname($data->getFirstname())
            ->setLastname($data->getLastname())
            ->setEmail($data->getEmail())
            ->setPhone($data->getPhone())
            ->setAddress($data->getAddress())
            ->setPostalCode($data->getPostalCode())
            ->setCity($data->getCity())
            ->setReceiveInformation($data->getReceiveInformation())
            ->setNotTransmitData($data->getNotTransmitData())
        ;

        $this->em->persist($getProgram);

        $this->em->flush();

        return $getProgram;
    }
}
