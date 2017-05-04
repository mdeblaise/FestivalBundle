<?php

namespace MMC\FestivalBundle\Services\Exponent;

use MMC\FestivalBundle\Entity\Exponent;
use MMC\FestivalBundle\Services\Lister\AbstractFakeLister;
use MMC\FestivalBundle\Services\Lister\Request as BaseRequest;

class FakeLister extends AbstractFakeLister
{
    public function getSupportedItemClass()
    {
        return Exponent::class;
    }

    public function support(BaseRequest $request)
    {
        if (!$request instanceof Request) {
            return false;
        }

        return parent::support($request);
    }
}
