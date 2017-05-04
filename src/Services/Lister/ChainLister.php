<?php

namespace MMC\FestivalBundle\Services\Lister;

class ChainLister implements Lister
{
    protected $listers;

    public function __construct()
    {
        $this->listers = [];
    }

    public function addLister(Lister $lister)
    {
        $this->listers[] = $lister;
    }

    public function support(Request $request)
    {
        foreach ($this->listers as $lister) {
            if ($lister->support($request)) {
                return true;
            }
        }

        return false;
    }

    public function execute(Request $request)
    {
        foreach ($this->listers as $lister) {
            if ($lister->support($request)) {
                return $lister->execute($request);
            }
        }
        $response = new Response($request);
        $response->setIsFake(true);

        return $response;
    }

    public function reset()
    {
        foreach ($this->listers as $lister) {
            $lister->reset();
        }
    }
}
