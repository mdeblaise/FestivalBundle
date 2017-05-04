<?php

namespace MMC\FestivalBundle\Services\Press;

use Doctrine\ORM\EntityManager;
use MMC\FestivalBundle\Entity\ContactPress;

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
        $contactPress = new ContactPress();

        $contactPress->setCivility($data->getCivility())
            ->setFirstname($data->getFirstname())
            ->setLastname($data->getLastname())
            ->setMedia($data->getMedia())
            ->setEmail($data->getEmail())
            ->setPhone($data->getPhone())
            ->setAddress($data->getAddress())
            ->setPostalCode($data->getPostalCode())
            ->setCity($data->getCity())
            ->setMessage($data->getMessage())
        ;

        $this->em->persist($contactPress);

        $this->em->flush();

        return $contactPress;
    }
}
