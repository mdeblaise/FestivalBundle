<?php

namespace MMC\FestivalBundle\Services\Guest;

use Doctrine\ORM\EntityRepository;
use MMC\FestivalBundle\Entity\CardGuest;
use MMC\FestivalBundle\Services\Lister\AbstractDoctrineLister;
use MMC\FestivalBundle\Services\Lister\Request as BaseRequest;

class DoctrineLister extends AbstractDoctrineLister
{
    protected $repository;

    public function __construct(
        EntityRepository $repository
    ) {
        if ($repository->getClassName() != CardGuest::class) {
            throw new \InvalidArgumentException('The repository must work with entites of type '.CardGuest::class);
        }
        $this->repository = $repository;
    }

    public function support(BaseRequest $request)
    {
        if (!$request instanceof Request) {
            return false;
        }

        return parent::support($request);
    }

    protected function getRepository()
    {
        return $this->repository;
    }

    protected function createSupportQueryBuilder(BaseRequest $request)
    {
        $queryBuilder = parent::createSupportQueryBuilder($request);

        if ($request->getEdition()) {
            $queryBuilder->andWhere('c.edition = :edition')
                         ->setParameter('edition', $request->getEdition());
        }

        return $queryBuilder;
    }

    protected function createQueryBuilder(BaseRequest $request)
    {
        $queryBuilder = parent::createQueryBuilder($request)
                ->orderBy('i.guestOfHonor', 'desc')
                ->addOrderBy('i.name', 'asc')
                ;

        if ($request->getGuestOfHonor()) {
            $queryBuilder->andWhere('i.guestOfHonor = :guestOfHOnor')
                         ->setParameter('guestOfHOnor', $request->getGuestOfHonor());
        }

        if ($request->getThisFriday()) {
            $queryBuilder->andWhere('i.thisFriday = :thisFriday')
                         ->setParameter('thisFriday', $request->getThisFriday());
        }

        if ($request->getThisSaturday()) {
            $queryBuilder->andWhere('i.thisSaturday = :thisSaturday')
                         ->setParameter('thisSaturday', $request->getThisSaturday());
        }

        if ($request->getThisSunday()) {
            $queryBuilder->andWhere('i.thisSunday = :thisSunday')
                         ->setParameter('thisSunday', $request->getThisSunday());
        }

        if ($request->getUnivers()) {
            $queryBuilder->andWhere('i.univers = :univers')
                         ->setParameter('univers', $request->getUnivers());
        }

        if ($request->getEdition()) {
            $queryBuilder->andWhere('c.edition = :edition')
                         ->setParameter('edition', $request->getEdition());
        }

        return $queryBuilder;
    }
}
