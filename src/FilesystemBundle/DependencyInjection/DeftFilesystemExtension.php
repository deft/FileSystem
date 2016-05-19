<?php

namespace Deft\FilesystemBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class DeftFilesystemExtension extends Extension implements PrependExtensionInterface
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');
    }

    public function prepend(ContainerBuilder $container)
    {
        $this->prependDoctrineConfig($container);
        $this->prependTwigConfig($container);
    }

    private function prependDoctrineConfig(ContainerBuilder $container)
    {
        $this->checkBundle($container, 'DoctrineBundle');

        $container->prependExtensionConfig('doctrine', [
            'orm' => [
                'entity_managers' => [
                    'deft_filesystem' => [
                        'mappings' => [
                            'deftfilesystem' => [
                                'type' => 'xml',
                                'dir' => realpath(sprintf("%s/../Resources/config/doctrine", __DIR__)),
                                'prefix' => sprintf('Deft\\Filesystem'),
                                'alias' => "DeftFilesystem",
                            ]
                        ]
                    ]
                ]
            ],
        ]);
    }

    private function prependTwigConfig(ContainerBuilder $container)
    {
        $this->checkBundle($container, 'TwigBundle');

        $container->prependExtensionConfig('twig', [
            'form_themes' => ['DeftFilesystemBundle:Form:form_theme.html.twig']
        ]);
    }

    private function checkBundle(ContainerBuilder $container, $bundleName)
    {
        $bundles = $container->getParameter('kernel.bundles');
        if (!isset($bundles[$bundleName])) {
            throw new \InvalidArgumentException(sprintf(
                "Cannot enable DeftFilesystemBundle because %s is not enabled",
                $bundleName
            ));
        }
    }
}
