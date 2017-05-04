<?php

namespace MMC\FestivalBundle\Services\Activity;

use MMC\FestivalBundle\Entity\DaysOfPresenceInterface;
use MMC\FestivalBundle\Services\Lister\AbstractRequest;

class Request extends AbstractRequest implements DaysOfPresenceInterface
{
    protected $thisFriday;
    protected $thisSaturday;
    protected $thisSunday;
    protected $univers;
    protected $type;
    protected $edition;

    public function setUnivers($univers)
    {
        $this->univers = $univers;

        return $this;
    }

    public function getUnivers()
    {
        return $this->univers;
    }

    public function setThisFriday(bool $thisFriday)
    {
        $this->thisFriday = $thisFriday;

        return $thisFriday;
    }

    public function getThisFriday()
    {
        return $this->thisFriday;
    }

    public function setThisSaturday(bool $thisSaturday)
    {
        $this->thisSaturday = $thisSaturday;

        return $this->thisSaturday;
    }

    public function getThisSaturday()
    {
        return $this->thisSaturday;
    }

    public function setThisSunday(bool $thisSunday)
    {
        $this->thisSunday = $thisSunday;

        return $this->thisSunday;
    }

    public function getThisSunday()
    {
        return $this->thisSunday;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getEdition()
    {
        return $this->edition;
    }

    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }
}
