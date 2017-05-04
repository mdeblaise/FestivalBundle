<?php

namespace MMC\FestivalBundle\Services\Activity;

use Doctrine\ORM\EntityRepository;
use MMC\FestivalBundle\Entity\CardActivity;
use MMC\FestivalBundle\Services\Lister\AbstractDoctrineLister;
use MMC\FestivalBundle\Services\Lister\Request as BaseRequest;

class DoctrineLister extends AbstractDoctrineLister
{
    protected $repository;

    protected $currentEdition;

    public function __construct(
        EntityRepository $repository
    ) {
        if ($repository->getClassName() != CardActivity::class) {
            throw new \InvalidArgumentException('The repository must work with entites of type '.CardActivity::class);
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

    /**
     * @param string $currentEdition
     */
    public function setCurrentEdition($currentEdition)
    {
        $this->currentEdition = $currentEdition;

        return $this;
    }

    protected function getRepository()
    {
        return $this->repository;
    }

    protected function createSupportQueryBuilder(BaseRequest $request)
    {
        $queryBuilder = parent::createSupportQueryBuilder($request);

        if ($request->getEdition()) {
            $queryBuilder->andWhere('i.edition = :edition')
                         ->setParameter('edition', $request->getEdition());
        }

        return $queryBuilder;
    }

    protected function createQueryBuilder(BaseRequest $request)
    {
        $queryBuilder = parent::createQueryBuilder($request)
                ->orderBy('i.title', 'asc')
                ;

        if ($request->getUnivers()) {
            $queryBuilder->andWhere('i.univers = :univers')
                         ->setParameter('univers', $request->getUnivers());
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

        if ($request->getType()) {
            $queryBuilder->andWhere('i.type = :type')
                         ->setParameter('type', $request->getType());
        }

        if ($request->getEdition()) {
            $queryBuilder->andWhere('i.edition = :edition')
                         ->setParameter('edition', $request->getEdition());
        }

        return $queryBuilder;
    }
}
