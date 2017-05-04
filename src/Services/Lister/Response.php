<?php

namespace MMC\FestivalBundle\Services\Lister;

class Response
{
    protected $list;
    protected $isFake;
    protected $nbResults;
    protected $nbPages;
    protected $currentPage;
    protected $request;

    public function __construct(Request $request)
    {
        $this->list = [];
        $this->isFake = false;
        $this->request = $request;
    }

    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    public function getList()
    {
        return $this->list;
    }

    public function setIsFake(bool $isFake)
    {
        $this->isFake = $isFake;

        return $this;
    }

    public function getIsFake()
    {
        return $this->isFake;
    }

    public function setNbResults($nbResults)
    {
        $this->nbResults = $nbResults;

        return $this;
    }

    public function getNbResults()
    {
        return $this->nbResults;
    }

    public function setNbPages($nbPages)
    {
        $this->nbPages = $nbPages;

        return $this;
    }

    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;

        return $this;
    }

    public function getNbPages()
    {
        return $this->nbPages;
    }

    public function getRequest()
    {
        return $this->request;
    }
}
