<?php

namespace Akyos\Quill\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('quill');

        $treeBuilder
            ->getRootNode()
                ->children()

                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
