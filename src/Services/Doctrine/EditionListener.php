<?php

namespace MMC\FestivalBundle\Services\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use MMC\FestivalBundle\Entity\Edition;

class EditionListener implements EventSubscriber
{
    protected $currentEdition;

    protected $em;

    public function getSubscribedEvents()
    {
        return ['onFlush', 'prePersist'];
    }

    public function onFlush(OnFlushEventArgs $args)
    {
        $em = $args->getEntityManager();
        $uow = $em->getUnitOfWork();

        $currentEdition = null;
        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            if ($entity instanceof Edition && $entity->getCurrent() === true) {
                $currentEdition = $entity;
            }
        }

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            if ($entity instanceof Edition && $entity->getCurrent() === true && isset($uow->getEntityChangeSet($entity)['current'])) {
                $currentEdition = $entity;
            }
        }

        if (!$currentEdition) {
            return;
        }

        $em = $args->getEntityManager();

        $editions = $em->getRepository(Edition::class)->findByCurrent(true);

        foreach ($editions as $edition) {
            if ($edition != $currentEdition) {
                $edition->setCurrent(false);
                $uow = $em->getUnitOfWork();
                $classMetadata = $em->getClassMetadata(get_class($edition));
                $uow->computeChangeSet($classMetadata, $edition);
            }
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Edition) {
            return;
        }

        $this->em = $args->getEntityManager();

        $currentEdition = $this->getCurrentEdition();

        if ($currentEdition != null) {
            return;
        }

        $entity->setCurrent(true);
    }

    public function getCurrentEdition()
    {
        $currentEdition = $this->em->getRepository(Edition::class)->findOneByCurrent(true);

        return $currentEdition;
    }
}
