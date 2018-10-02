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
                ->scalarNode('app_id')->isRequired()->end()
                ->scalarNode('secret')->isRequired()->end()
                ->scalarNode('token')->isRequired()->end()
                ->scalarNode('aes_key')->isRequired()->end()
            ->end()
            ;

        return $treeBuilder;
    }
}
