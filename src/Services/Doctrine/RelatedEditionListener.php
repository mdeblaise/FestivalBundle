<?php

namespace MMC\FestivalBundle\Services\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use MMC\FestivalBundle\Entity\Behavior\RelatedEditionInterface;
use MMC\FestivalBundle\Entity\Edition;
use Ramsey\Uuid\Uuid;

class RelatedEditionListener implements EventSubscriber
{
    protected $em;

    public function getSubscribedEvents()
    {
        return ['prePersist'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof RelatedEditionInterface) {
            return;
        }

        $this->em = $args->getEntityManager();

        $globalCode = $this->generateGlobalCode($entity);
        $edition = $this->getCurrentEdition();

        $entity->setGlobalCode($globalCode)
            ->setEdition($edition)
        ;
    }

    public function getCurrentEdition()
    {
        $currentEdition = $this->em->getRepository(Edition::class)->findOneByCurrent(true);

        return $currentEdition;
    }

    public function generateGlobalCode(RelatedEditionInterface $entity)
    {
        if ($entity->getGlobalCode() === null) {
            return Uuid::uuid4();
        } else {
            return $entity->getGlobalCode();
        }
    }
}
