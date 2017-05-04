<?php

namespace MMC\FestivalBundle\Services\Actuality;

use MMC\FestivalBundle\Services\Lister\AbstractRequest;

class Request extends AbstractRequest
{
    protected $dateReference;

    public function getDateReference()
    {
        return $this->dateReference;
    }

    public function setDateReference($dateReference)
    {
        $this->dateReference = $dateReference;

        return $this;
    }
}
