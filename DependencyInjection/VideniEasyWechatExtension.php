<?php

namespace Videni\Bundle\EasyWechatBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use EasyWeChat\OpenPlatform\Application as OpenPlatformApplication;
use Symfony\Component\DependencyInjection\Definition;

class VideniEasyWechatExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $this->registerWechatFactory($container, $config, $loader);
    }

    protected function registerWechatFactory(ContainerBuilder $container, array $config, $loader): void
    {
        if ($config['factory'] === 'open_platform') {
            $loader->load('open_platform.yml');

            $container->setDefinition(OpenPlatformApplication::class, new Definition(OpenPlatformApplication::class, [
                    [
                    'app_id' => $config['app_id'],
                    'secret' => $config['secret'],
                    'token' => $config['token'],
                    'aes_key' => $config['aes_key']
                    ],
            ]));
        }
    }
}
