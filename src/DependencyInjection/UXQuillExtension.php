<?php

namespace Akyos\UXQuill\DependencyInjection;

use Akyos\UXQuill\Form\QuillType;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

class UXQuillExtension extends ConfigurableExtension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container)
    {
        // Register the Quill form theme if TwigBundle is available
        $bundles = $container->getParameter('kernel.bundles');

        if (isset($bundles['TwigBundle'])) {
            $container->prependExtensionConfig('twig', ['form_themes' => ['@UXQuill/theme.html.twig']]);
        }

        if ($this->isAssetMapperAvailable($container)) {
            $container->prependExtensionConfig('framework', [
                'asset_mapper' => [
                    'paths' => [
                        __DIR__.'/../../assets/dist' => '@akyoscommunication/ux-quill',
                    ],
                ],
            ]);
        }
    }

    protected function loadInternal(array $configs, ContainerBuilder $container): void
    {
        $this->loadResources($container);

        $container->getDefinition('quill.configuration')
            ->setArgument(0, $configs)
        ;

        $container
            ->setDefinition('form.quill', new Definition(QuillType::class))
            ->setArgument(0, new Reference('quill.configuration'))
            ->addTag('form.type')
        ;
    }

    private function loadResources(ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../../config'));

        $resources = [
            'config',
            'form',
        ];

        foreach ($resources as $resource) {
            $loader->load($resource.'.yaml');
        }
    }

    private function isAssetMapperAvailable(ContainerBuilder $container): bool
    {
        if (!interface_exists(AssetMapperInterface::class)) {
            return false;
        }

        // check that FrameworkBundle 6.3 or higher is installed
        $bundlesMetadata = $container->getParameter('kernel.bundles_metadata');
        if (!isset($bundlesMetadata['FrameworkBundle'])) {
            return false;
        }

        return is_file($bundlesMetadata['FrameworkBundle']['path'].'/Resources/config/asset_mapper.php');
    }
}
