<?php

namespace MMC\FestivalBundle\Services\Lister;

use MMC\FestivalBundle\Services\Lister\Request as BaseRequest;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;

abstract class AbstractFakeLister implements Lister
{
    protected $items;

    public function __construct()
    {
        $this->reset();
    }

    abstract public function getSupportedItemClass();

    public function support(BaseRequest $request)
    {
        return count($this->items) > 0;
    }

    protected function getList(BaseRequest $request)
    {
        return $this->items;
    }

    public function execute(BaseRequest $request)
    {
        $response = $this->createResponse($request);

        $list = $this->getList($request);

        $adapter = new ArrayAdapter($list);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage($request->getMaxPerPage());
        $pagerfanta->setCurrentPage($request->getCurrentPage());

        $currentPageResults = $pagerfanta->getCurrentPageResults();

        $nbResults = $pagerfanta->getNbResults();
        $nbPages = $pagerfanta->getNbPages();

        $response->setList($currentPageResults)
            ->setNbResults($nbResults)
            ->setNbPages($nbPages)
            ->setIsFake(true)
            ;

        return $response;
    }

    public function reset()
    {
        $this->items = [];
    }

    public function addItem($item)
    {
        $supportedItemClass = $this->getSupportedItemClass();
        if (!$item instanceof $supportedItemClass) {
            throw new \RuntimeException('Bad item');
        }

        $this->items[] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setRepository(ListerRepository $repository)
    {
        foreach ($repository->findAll() as $item) {
            $this->addItem($item);
        }
    }

    protected function createResponse(Request $request)
    {
        return new Response($request);
    }
}
