<?php

namespace MMC\FestivalBundle\Services\Edition;

use Doctrine\ORM\EntityManager;
use MMC\FestivalBundle\Entity\Edition;

class EditionProvider implements EditionProviderInterface
{
    protected $em;

    public function __construct(
        EntityManager $em
    ) {
        $this->em = $em;
    }

    public function getCurrentEdition()
    {
        return $this->em->getRepository(Edition::class)->findOneByCurrent(true);
    }

    public function getActiveEdition()
    {
        return $this->em->getRepository(Edition::class)->findOneByActive(true);
    }
}
