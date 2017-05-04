<?php

namespace MMC\FestivalBundle\Services;

trait EnumUniversProviderAwareTrait
{
    protected $enumUniversProvider;

    /**
     * @return EnumUniversProviderInterface
     */
    public function getEnumUniversProvider()
    {
        return $this->enumUniversProvider;
    }

    /**
     * @param EnumUniversProviderInterface $enumUniversProvider
     */
    public function setEnumUniversProvider($enumUniversProvider)
    {
        $this->enumUniversProvider = $enumUniversProvider;

        return $this;
    }
}
