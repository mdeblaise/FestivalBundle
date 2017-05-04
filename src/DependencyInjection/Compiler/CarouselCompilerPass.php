<?php

namespace MMC\FestivalBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class CarouselCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('mmc_festival.Carousel');
        $taggedServices = $container->findTaggedServiceIds('mmc_festival.Carousel');
        foreach ($taggedServices as $id => $properties) {
            $definition->addMethodCall(
                'addCarousel',
                [new Reference($id)]
            );
        }
    }
}
