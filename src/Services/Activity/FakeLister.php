<?php

namespace MMC\FestivalBundle\Services\Activity;

use MMC\FestivalBundle\Entity\Activity;
use MMC\FestivalBundle\Services\Lister\AbstractFakeLister;
use MMC\FestivalBundle\Services\Lister\Request as BaseRequest;

class FakeLister extends AbstractFakeLister
{
    public function getSupportedItemClass()
    {
        return Activity::class;
    }

    public function support(BaseRequest $request)
    {
        if (!$request instanceof Request) {
            return false;
        }

        return parent::support($request);
    }
}
