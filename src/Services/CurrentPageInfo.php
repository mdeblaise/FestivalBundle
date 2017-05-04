<?php

namespace MMC\FestivalBundle\Services;

use Symfony\Component\HttpFoundation\RequestStack;

class CurrentPageInfo
{
    protected $requestStack;

    public function __construct(
        RequestStack $requestStack
    ) {
        $this->requestStack = $requestStack;
    }

    public function getMenu()
    {
        $request = $this->requestStack->getCurrentRequest();

        if (preg_match('/^mmc_festival_([a-zA-Z0-9]+)/', $request->get('_route'), $matches)) {
            return $matches[1];
        }

        return;
    }

    public function getSubMenu()
    {
        $request = $this->requestStack->getCurrentRequest();

        if (preg_match('/^mmc_festival_([a-zA-Z0-9]+)_(\w+)/', $request->get('_route'), $matches)) {
            switch ($matches[2]) {
                case 'univers':
                    return $request->get('_route_params') ? $request->get('_route_params')['univers'] : $matches[2];
                case 'day':
                    return $request->get('_route_params') ? $request->get('_route_params')['day'] : $matches[2];
                default:
                    return $matches[2];
            }
        }

        return;
    }
}
