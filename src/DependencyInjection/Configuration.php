<?php

namespace Akyos\UXQuill\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('ux_quill');

        $treeBuilder
            ->getRootNode()
                ->children()
                    ->scalarNode('default_config')->defaultValue(null)->end()
                    ->append($this->createConfigsNode())
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }

    private function createConfigsNode(): ArrayNodeDefinition
    {
        return $this->createPrototypeNode('configs')
                ->arrayPrototype()
                    ->normalizeKeys(false)
                    ->useAttributeAsKey('name')
                    ->variablePrototype()
                ->end()
            ->end()
        ;
    }

    private function createPrototypeNode(string $name): ArrayNodeDefinition
    {
        return $this->createNode($name)
            ->normalizeKeys(false)
            ->useAttributeAsKey('name');
    }

    private function createNode(string $name): ArrayNodeDefinition
    {
        if (\method_exists(TreeBuilder::class, 'getRootNode')) {
            $treeBuilder = new TreeBuilder($name);
            $node = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $treeBuilder = new TreeBuilder();
            $node = $treeBuilder->root($name);
        }

        \assert($node instanceof ArrayNodeDefinition);

        return $node;
    }
}
