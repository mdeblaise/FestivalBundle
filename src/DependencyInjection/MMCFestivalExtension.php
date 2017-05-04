<?php

namespace MMC\FestivalBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class MMCFestivalExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $env = $container->getParameter('kernel.environment');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ($env != 'test') {
            $loader->load('admin.yml');
        }

        //Carousels
        foreach ($config['carousel'] as $name => $value) {
            $this->addParameter('carousel', $name, $config, $container);
        }

        //Path
        foreach ($config['path'] as $name => $value) {
            $this->addParameter('path', $name, $config, $container);
        }

        //Google_analytics
        foreach ($config['google_analytics'] as $name => $value) {
            $this->addParameter('google_analytics', $name, $config, $container);
        }

        //Fake actualities
        if (isset($config['fake_actualities'])) {
            $container->setParameter('mmc_festival.fake_actualities', $config['fake_actualities']);
        }

        //Alt text
        if (isset($config['alt_text'])) {
            $container->setParameter('mmc_festival.alt_text', $config['alt_text']);
        }

        //Enum univers provider class
        if (isset($config['univers_class'])) {
            $container->setParameter('mmc_festival.univers.class', $config['univers_class']);
        }

        //Schedule
        if (isset($config['schedule'])) {
            $container->setParameter('mmc_festival.schedule.reference_date', $config['schedule']['reference_date']);
            $container->setParameter('mmc_festival.schedule.festival_length', $config['schedule']['festival_length']);
            $container->setParameter('mmc_festival.schedule.preparation_length', $config['schedule']['preparation_length']);
        }

        //Emails
        foreach ($config['emails'] as $name => $value) {
            $this->addParameter('emails', $name, $config, $container);
        }

        //Resources Path
        $container->setParameter('mmc_festival.resourcesPath', $config['resourcesPath']);

        //Year of current edition
        $container->setParameter('mmc_festival.current_edition', $config['current_edition']);
    }

    protected function addParameter($group, $key, $config, ContainerBuilder $container)
    {
        if (isset($config[$group][$key]) && $key != 'enabled') {
            $container->setParameter('mmc_festival.'.$group.'.'.$key, $config[$group][$key]);
        }
    }

    public function prepend(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        if ($config['path']['enabled']) {
            $twig_globals = [
                'globals' => [
                    'mmc_festival_bootstrap_css_path' => $config['path']['bootstrap_css'],
                    'mmc_festival_bootstrap_dialog_css_path' => $config['path']['bootstrap_dialog_css'],
                    'mmc_festival_bootstrap_toggle_css_path' => $config['path']['bootstrap_toggle_css'],
                    'mmc_festival_fontawesome_css_path' => $config['path']['fontawesome_css'],
                ],
            ];

            $container->prependExtensionConfig('twig', $twig_globals);
        }

        if ($config['google_analytics']['enabled']) {
            $twig_globals = [
                'globals' => [
                    'mmc_festival_google_analytics_key' => $config['google_analytics']['key'],
                ],
            ];

            $container->prependExtensionConfig('twig', $twig_globals);
        }

        $stof_doctrine_extensions = [
            'orm' => [
                'default' => [
                    'timestampable' => true,
                    'uploadable' => true,
                ],
            ],
        ];

        $container->prependExtensionConfig('stof_doctrine_extensions', $stof_doctrine_extensions);
    }
}
