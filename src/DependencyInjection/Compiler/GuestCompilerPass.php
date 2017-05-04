<?php

namespace MMC\FestivalBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class GuestCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('mmc_festival.ChainLister.Guest');
        $taggedServices = $container->findTaggedServiceIds('mmc_festival.ChainLister.Guest');
        foreach ($taggedServices as $id => $properties) {
            $definition->addMethodCall(
                'addLister',
                [new Reference($id)]
            );
        }
    }
}
