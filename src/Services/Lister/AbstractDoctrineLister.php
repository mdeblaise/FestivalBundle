<?php

namespace MMC\FestivalBundle\Services\Lister;

use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

abstract class AbstractDoctrineLister implements Lister
{
    protected $supportLimit = 10;

    public function setSupportLimit($limit)
    {
        $this->supportLimit = $limit;
    }

    public function support(Request $request)
    {
        $queryBuilder = $this->createSupportQueryBuilder($request);

        return $queryBuilder->getQuery()->getSingleScalarResult() >= $this->supportLimit;
    }

    public function execute(Request $request)
    {
        $response = $this->createResponse($request);

        $queryBuilder = $this->createQueryBuilder($request);

        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage($request->getMaxPerPage());
        $pagerfanta->setCurrentPage($request->getCurrentPage());

        $currentPageResults = $pagerfanta->getCurrentPageResults();

        $response->setList($currentPageResults)
            ->setNbResults($pagerfanta->getNbResults())
            ->setNbPages($pagerfanta->getNbPages())
            ->setCurrentPage($pagerfanta->getCurrentPage())
            ;

        return $response;
    }

    abstract protected function getRepository();

    protected function createSupportQueryBuilder(Request $request)
    {
        $queryBuilder = $this->getRepository()
            ->createQueryBuilder('c')
            ->select('COUNT(DISTINCT c)')
            ->innerJoin('c.items', 'i')
            ->andWhere('i.status IN(:status)')
            ->setParameter('status', $request->getStatus());

        return $queryBuilder;
    }

    protected function createQueryBuilder(Request $request)
    {
        $queryBuilder = $this->getRepository()
            ->createQueryBuilder('c')
            ->innerJoin('c.items', 'i')
            ->andWhere('i.status IN(:status)')
            ->groupBy('i.card')
            ->setParameter('status', $request->getStatus());

        return $queryBuilder;
    }

    protected function createResponse(Request $request)
    {
        return new Response($request);
    }

    public function reset()
    {
        return;
    }
}
