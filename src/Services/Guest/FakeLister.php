<?php

namespace MMC\FestivalBundle\Services\Guest;

use MMC\FestivalBundle\Entity\Guest;
use MMC\FestivalBundle\Services\Lister\AbstractFakeLister;
use MMC\FestivalBundle\Services\Lister\Request as BaseRequest;

class FakeLister extends AbstractFakeLister
{
    public function getSupportedItemClass()
    {
        return Guest::class;
    }

    public function support(BaseRequest $request)
    {
        if (!$request instanceof Request) {
            return false;
        }

        return parent::support($request);
    }
}
