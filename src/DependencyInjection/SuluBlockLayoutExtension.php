<?php

declare(strict_types=1);

namespace Depa\SuluBlockLayoutBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;

class SuluBlockLayoutExtension extends Extension implements PrependExtensionInterface
{
    use BlockMetadataLoaderTrait;

    public function load(array $configs, ContainerBuilder $container): void
    {
        $metadata = $this->loadMetadataFromXml(__DIR__ . '/../../Resources/config/blocks');

        $container->setParameter('sulu_block_layout.bundle_metadata', [
            'bundle'   => 'SuluBlockLayoutBundle',
            'package'  => 'depa-berlin/sulu-block-layout',
            'blocks'   => $metadata['blocks'],
            'children' => $metadata['children'],
        ]);
    }

    public function prepend(ContainerBuilder $container): void
    {
        if ($container->hasExtension('twig')) {
            $container->prependExtensionConfig('twig', [
                'paths' => [
                    __DIR__ . '/../../Resources/views' => null,
                ],
            ]);
        }

        if ($container->hasExtension('sulu_admin')) {
            $container->prependExtensionConfig('sulu_admin', [
                'templates' => [
                    'block' => [
                        'directories' => [
                            'sulu_block_layout' => __DIR__ . '/../../Resources/config/blocks',
                        ],
                    ],
                ],
            ]);
        }
    }
}
