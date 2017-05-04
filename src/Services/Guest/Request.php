<?php

namespace MMC\FestivalBundle\Services\Guest;

use MMC\FestivalBundle\Entity\DaysOfPresenceInterface;
use MMC\FestivalBundle\Services\Lister\AbstractRequest;

class Request extends AbstractRequest implements DaysOfPresenceInterface
{
    protected $guestOfHonor;
    protected $thisFriday;
    protected $thisSaturday;
    protected $thisSunday;
    protected $univers;
    protected $edition;

    public function setGuestOfHonor(bool $guestOfHonor)
    {
        $this->guestOfHonor = $guestOfHonor;

        return $this;
    }

    public function getGuestOfHonor()
    {
        return $this->guestOfHonor;
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

    public function setUnivers($univers)
    {
        $this->univers = $univers;

        return $this;
    }

    public function getUnivers()
    {
        return $this->univers;
    }

    /**
     * @return string
     */
    public function getEdition()
    {
        return $this->edition;
    }

    /**
     * @param string $edition
     */
    public function setEdition($edition)
    {
        $this->edition = $edition;

        return $this;
    }
}
