<?php

namespace MMC\FestivalBundle\Services\Lister;

interface Lister
{
    public function support(Request $request);

    public function execute(Request $request);

    public function reset();
}
