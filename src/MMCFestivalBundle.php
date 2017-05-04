<?php

namespace MMC\FestivalBundle;

use MMC\FestivalBundle\DependencyInjection\Compiler\ActivityCompilerPass;
use MMC\FestivalBundle\DependencyInjection\Compiler\ActualityCompilerPass;
use MMC\FestivalBundle\DependencyInjection\Compiler\CarouselCompilerPass;
use MMC\FestivalBundle\DependencyInjection\Compiler\ExponentCompilerPass;
use MMC\FestivalBundle\DependencyInjection\Compiler\GuestCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class MMCFestivalBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new ActualityCompilerPass());
        $container->addCompilerPass(new GuestCompilerPass());
        $container->addCompilerPass(new CarouselCompilerPass());
        $container->addCompilerPass(new ActivityCompilerPass());
        $container->addCompilerPass(new ExponentCompilerPass());
    }
}
