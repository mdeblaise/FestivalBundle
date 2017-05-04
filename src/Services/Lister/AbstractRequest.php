<?php

namespace MMC\FestivalBundle\Services\Lister;

abstract class AbstractRequest implements Request
{
    protected $status;
    protected $maxPerPage;
    protected $currentPage = 1;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getMaxPerPage()
    {
        return $this->maxPerPage;
    }

    public function setMaxPerPage($maxPerPage)
    {
        $this->maxPerPage = $maxPerPage;

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
}
