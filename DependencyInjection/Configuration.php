<?php

namespace Videni\Bundle\EasyWechatBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('videni_easy_wechat');

         $rootNode
            ->children()
                ->scalarNode('factory')
                    ->isRequired()
                    ->validate()
                        ->ifNotInArray(array('official_account', 'mini_program', 'open_platform'))
                        ->thenInvalid('Invalid factory %s, available factories are official_account, mini_program, open_platform')
                    ->end()
                ->end()
                ->scalarNode('app_id')->isRequired()->end()
                ->scalarNode('secret')->isRequired()->end()
                ->scalarNode('token')->end()
                ->scalarNode('aes_key')->end()
            ->end()
            ->beforeNormalization()
                    ->ifTrue(function ($c) {
                        if (!isset($c['factory'])) {
                            return false;
                        }
                        if ($c['factory'] !== 'open_platform') {
                            return false;
                        }
                        if (!isset($c['token']) || !isset($c['aes_key'])) {
                            return true;
                        }
                    })
                    ->thenInvalid("You should also set 'token', 'aes_key' for open_platform factory.")
            ->end()
        ;

        return $treeBuilder;
    }
}
