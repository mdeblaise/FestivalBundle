<?php

namespace MMC\FestivalBundle\Services\Exponent;

use Doctrine\ORM\EntityRepository;
use MMC\FestivalBundle\Entity\CardExponent;
use MMC\FestivalBundle\Services\Lister\AbstractDoctrineLister;
use MMC\FestivalBundle\Services\Lister\Request as BaseRequest;

class DoctrineLister extends AbstractDoctrineLister
{
    protected $repository;

    public function __construct(
        EntityRepository $repository
    ) {
        if ($repository->getClassName() != CardExponent::class) {
            throw new \InvalidArgumentException('The repository must work with entites of type '.CardExponent::class);
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
                ->orderBy('i.name', 'asc')
                ;

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
