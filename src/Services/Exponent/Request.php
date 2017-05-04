<?php

namespace MMC\FestivalBundle\Services\Exponent;

use MMC\FestivalBundle\Services\Lister\AbstractRequest;

class Request extends AbstractRequest
{
    protected $univers;
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
