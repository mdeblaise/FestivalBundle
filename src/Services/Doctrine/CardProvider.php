<?php

namespace MMC\FestivalBundle\Services\Doctrine;

use Doctrine\ORM\EntityManager;
use MMC\FestivalBundle\Entity\Edition;
use Ramsey\Uuid\Uuid;

class CardProvider
{
    protected $em;

    public function __construct(
        EntityManager $em
    ) {
        $this->em = $em;
    }

    public function getExist(string $className, Edition $edition, Uuid $globalCode)
    {
        return $this->em->getRepository($className)->findOneBy(['edition' => $edition, 'globalCode' => $globalCode]);
    }
}
