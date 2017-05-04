<?php

namespace MMC\FestivalBundle\Services\Actuality;

use Doctrine\ORM\EntityRepository;
use MMC\FestivalBundle\Entity\CardActuality;
use MMC\FestivalBundle\Services\Lister\AbstractDoctrineLister;
use MMC\FestivalBundle\Services\Lister\Request as BaseRequest;

class DoctrineLister extends AbstractDoctrineLister
{
    protected $repository;

    public function __construct(
        EntityRepository $repository
    ) {
        if ($repository->getClassName() != CardActuality::class) {
            throw new \InvalidArgumentException('The repository must work with entites of type '.CardActuality::class);
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

    protected function createQueryBuilder(BaseRequest $request)
    {
        $queryBuilder = parent::createQueryBuilder($request);

        $queryBuilder
            ->orderBy('i.publishedAt', 'desc')
            ;

        if ($request->getDateReference()) {
            $queryBuilder->andWhere('i.publishedAt < :date')
                    ->setParameter('date', $request->getDateReference())
                    ;
        }

        return $queryBuilder;
    }
}
