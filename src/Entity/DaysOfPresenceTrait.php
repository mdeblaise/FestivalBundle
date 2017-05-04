<?php

namespace MMC\FestivalBundle\Entity;

trait DaysOfPresenceTrait
{
    /**
     * @ORM\Column(type="boolean")
     */
    private $thisFriday;

    /**
     * @ORM\Column(type="boolean")
     */
    private $thisSaturday;

    /**
     * @ORM\Column(type="boolean")
     */
    private $thisSunday;

    public function getThisFriday()
    {
        return $this->thisFriday;
    }

    public function setThisFriday($thisFriday)
    {
        $this->thisFriday = $thisFriday;

        return $this;
    }

    public function getThisSaturday()
    {
        return $this->thisSaturday;
    }

    public function setThisSaturday($thisSaturday)
    {
        $this->thisSaturday = $thisSaturday;

        return $this;
    }

    public function getThisSunday()
    {
        return $this->thisSunday;
    }

    public function setThisSunday($thisSunday)
    {
        $this->thisSunday = $thisSunday;

        return $this;
    }
}
