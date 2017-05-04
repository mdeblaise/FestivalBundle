<?php

namespace MMC\FestivalBundle\Services\Actuality;

use MMC\FestivalBundle\Entity\Actuality;
use MMC\FestivalBundle\Services\Lister\AbstractFakeLister;
use MMC\FestivalBundle\Services\Lister\Request as BaseRequest;

class FakeLister extends AbstractFakeLister
{
    public function getSupportedItemClass()
    {
        return Actuality::class;
    }

    public function support(BaseRequest $request)
    {
        if (!$request instanceof Request) {
            return false;
        }

        return parent::support($request);
    }

    protected function getList(BaseRequest $request)
    {
        $listActualities = [];
        $count = 0;

        usort($this->items, [$this, 'compareDateTime']);

        foreach ($this->items as $actuality) {
            if ($count != $request->getMaxPerPage()) {
                if ($actuality->getPublishedAt() < $request->getDateReference()) {
                    $listActualities[] = $actuality;
                    ++$count;
                }
            }
        }

        return $listActualities;
    }

    public function compareDateTime($a, $b)
    {
        if ($a->getPublishedAt() == $b->getPublishedAt()) {
            return 0;
        }

        return ($a->getPublishedAt() < $b->getPublishedAt()) ? 1 : -1;
    }
}
