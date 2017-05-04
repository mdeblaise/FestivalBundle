<?php

namespace MMC\FestivalBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mmc_festival');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $this->addCarousel($rootNode);
        $this->addFakeActualities($rootNode);
        $this->config($rootNode);

        return $treeBuilder;
    }

    protected function addCarousel($rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('carousel')
                    ->children()
                        ->arrayNode('home')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('alt')->end()
                                    ->scalarNode('src')->isRequired()->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('become_exponent')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('title')->end()
                                    ->scalarNode('src')->isRequired()->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    protected function addFakeActualities($rootNode)
    {
        $rootNode
            ->children()
                ->arrayNode('fake_actualities')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('title')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('contents')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('publishedAt')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('illustration')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('alt')->end()
                            ->scalarNode('link')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('target')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }

    protected function config($rootNode)
    {
        $rootNode
            ->children()
                ->scalarNode('current_edition')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('alt_text')
                    ->defaultValue('')
                ->end()
                ->scalarNode('univers_class')
                    ->defaultValue('MMC\FestivalBundle\Model\Univers')
                ->end()
                ->arrayNode('schedule')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('reference_date')
                            ->defaultValue('2017-01-01')
                        ->end()
                        ->integerNode('festival_length')
                            ->defaultValue(2)
                        ->end()
                        ->integerNode('preparation_length')
                            ->defaultValue(2)
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('path')
                    ->canBeEnabled()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('bootstrap_css')
                            ->defaultValue('/bundles/mmcfestival/css/bootstrap.min.css')
                        ->end()
                        ->scalarNode('bootstrap_dialog_css')
                            ->defaultValue('/bundles/mmcfestival/css/bootstrap-dialog.min.css')
                        ->end()
                        ->scalarNode('bootstrap_toggle_css')
                            ->defaultValue('/bundles/mmcfestival/css/bootstrap-toggle.min.css')
                        ->end()
                        ->scalarNode('fontawesome_css')
                            ->defaultValue('/bundles/mmcfestival/css/font-awesome.min.css')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('emails')
                    ->canBeEnabled()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('contact_sender_email')
                            ->defaultValue('server@meuhmeuhconcept.com')
                        ->end()
                        ->scalarNode('contact_staff_email')
                            ->defaultValue('server@meuhmeuhconcept.com')
                        ->end()
                        ->scalarNode('contact_exponent_email')
                            ->defaultValue('server@meuhmeuhconcept.com')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('google_analytics')
                    ->canBeEnabled()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('key')
                            ->defaultValue('null')
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('resourcesPath')
                    ->canBeEnabled()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('js_activity')
                            ->defaultValue('/bundles/mmcfestival/js/activity.js')
                        ->end()
                        ->scalarNode('js_guest')
                            ->defaultValue('/bundles/mmcfestival/js/guest.js')
                        ->end()
                        ->scalarNode('js_require')
                            ->defaultValue('/bundles/mmcfestival/js/lib/require.min.js')
                        ->end()
                        ->scalarNode('js_front')
                            ->defaultValue('/bundles/mmcfestival/js/front.js')
                        ->end()
                        ->scalarNode('img_univers')
                            ->defaultValue('/bundles/mmcfestival/images/univers/')
                        ->end()
                        ->scalarNode('img_partager')
                            ->defaultValue('/bundles/mmcfestival/images/partager.png')
                        ->end()
                        ->scalarNode('img_visuel_staff')
                            ->defaultValue('/bundles/mmcfestival/images/staff/visuel-staff.jpg')
                        ->end()
                        ->scalarNode('img_activityType')
                            ->defaultValue('/bundles/mmcfestival/images/activityType/')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
