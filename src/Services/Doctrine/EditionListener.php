<?php

namespace MMC\FestivalBundle\Services\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\OnFlushEventArgs;
use MMC\FestivalBundle\Entity\DaysOfPresence;
use MMC\FestivalBundle\Entity\Edition;

class EditionListener implements EventSubscriber
{
    protected $currentEdition;

    protected $em;

    public function getSubscribedEvents()
    {
        return ['onFlush', 'prePersist', 'postPersist', 'postUpdate'];
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

    public function postPersist(LifecycleEventArgs $args)
    {
        $edition = $args->getObject();

        if (!$edition instanceof Edition) {
            return;
        }

        $festivalLength = $edition->getFestivalLength();
        $referenceDate = $edition->getReferenceDate();

        for ($i = 0; $i < $festivalLength; ++$i) {
            if ($i == 0) {
                $dayOfPresence = new DaysOfPresence();
                $dayOfPresence->setDateOfPresence($referenceDate);
            } else {
                $dayOfPresence = new DaysOfPresence();
                $dayOfPresence->setDateOfPresence($referenceDate->modify('+1 day'));
            }

            $dayOfPresence->setEdition($edition);

            $this->em->persist($dayOfPresence);
            $this->em->flush();
        }
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $edition = $args->getObject();

        if (!$edition instanceof Edition) {
            return;
        }

        $this->em = $args->getEntityManager();

        $currentDaysOfPresence = $edition->getDaysOfPresence()->getValues();
        $festivalLength = $edition->getFestivalLength();
        $referenceDate = clone $edition->getReferenceDate();
        $newDaysOfPresence = [];

        for ($i = 0; $i < $festivalLength; ++$i) {
            if ($i == 0) {
                $dayOfPresence = new DaysOfPresence();
                $dayOfPresence->setDateOfPresence(clone $referenceDate);
            } else {
                $dayOfPresence = new DaysOfPresence();
                $dayOfPresence->setDateOfPresence(clone $referenceDate->modify('+1 day'));
            }
            $dayOfPresence->setEdition($edition);
            $newDaysOfPresence[] = $dayOfPresence;
        }

        $daysOfPresence = $this->diffDaysOfPresence($currentDaysOfPresence, $newDaysOfPresence);

        if ($daysOfPresence === null) {
            return;
        }

        foreach ($daysOfPresence['daysDeleted'] as $dayOfPresenceDeleted) {
            $this->em->remove($dayOfPresenceDeleted);
        }

        foreach ($daysOfPresence['daysAdded'] as $dayOfPresenceAdded) {
            $this->em->persist($dayOfPresenceAdded);
        }

        $this->em->flush();
    }

    public function diffDaysOfPresence(array $currentDaysOfPresence, array $newDaysOfPresence)
    {
        $days = [];
        $daysDeleted = [];
        $daysAdded = [];

        foreach ($newDaysOfPresence as $newDayOfPresence) {
            if (!$this->inDaysOfPresenceArray($newDayOfPresence, $currentDaysOfPresence)) {
                $daysAdded[] = $newDayOfPresence;
            }
        }

        foreach ($currentDaysOfPresence as $currentDayOfPresence) {
            if (!$this->inDaysOfPresenceArray($currentDayOfPresence, $newDaysOfPresence)) {
                $daysDeleted[] = $currentDayOfPresence;
            }
        }

        $days['daysAdded'] = $daysAdded;
        $days['daysDeleted'] = $daysDeleted;

        if (empty($days['daysAdded']) && empty($days['daysDeleted'])) {
            $days = null;
        }

        return $days;
    }

    public function inDaysOfPresenceArray($a, array $b)
    {
        foreach ($b as $c) {
            if ((string) $a == (string) $c) {
                return true;
            }
        }

        return false;
    }

    public function getCurrentEdition()
    {
        $currentEdition = $this->em->getRepository(Edition::class)->findOneByCurrent(true);

        return $currentEdition;
    }
}
