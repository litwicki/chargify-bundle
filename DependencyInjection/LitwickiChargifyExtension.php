<?php

namespace Litwicki\Bundle\ChargifyBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class LitwickiChargifyExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new LitwickiChargifyConfiguration();
        $config = $this->processConfiguration($configuration, $configs);

        $configs = reset($configs);

        $testMode = isset($configs['test_mode']) ? $configs['test_mode'] : true;
        $dataFormat = isset($configs['data_format']) ? $configs['data_format'] : 'json';
        $routePrefix = isset($configs['route_prefix']) ? $configs['route_prefix'] : '/chargify';

        /**
         * Assign defaults
         */
        $container->setParameter('chargify.test_mode', $testMode);
        $container->setParameter('chargify.data_format', $dataFormat);
        $container->setParameter('chargify.route_prefix', $routePrefix);

        /**
         * Assign API Params
         */
        $container->setParameter('chargify.api_key', $configs['api_key']);
        $container->setParameter('chargify.shared_key', $configs['shared_key']);
        $container->setParameter('chargify.domain', $configs['domain']);

        /**
         * Chargify Direct (v2 API) params not required.
         */
        if(isset($configs['direct'])) {
            $direct = $configs['direct'];
            $container->setParameter('chargify.api_id', $direct['api_id']);
            $container->setParameter('chargify.api_secret', $direct['api_secret']);
            $container->setParameter('chargify.api_password', $direct['api_password']);
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
