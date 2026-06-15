<?php

declare(strict_types=1);

namespace Depa\SuluBlockLayoutBundle\Tests\Unit\DependencyInjection;

use Depa\SuluBlockLayoutBundle\DependencyInjection\SuluBlockLayoutExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SuluBlockLayoutExtensionTest extends TestCase
{
    private ContainerBuilder $container;
    private SuluBlockLayoutExtension $extension;

    protected function setUp(): void
    {
        $this->container = new ContainerBuilder();
        $this->extension = new SuluBlockLayoutExtension();
    }

    public function testLoadSetsBundleMetadataParameter(): void
    {
        $this->extension->load([], $this->container);
        self::assertTrue($this->container->hasParameter('sulu_block_layout.bundle_metadata'));
    }

    public function testBundleMetadataHasRequiredKeys(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_layout.bundle_metadata');
        self::assertIsArray($meta);
        self::assertArrayHasKey('bundle', $meta);
        self::assertArrayHasKey('package', $meta);
        self::assertArrayHasKey('blocks', $meta);
        self::assertArrayHasKey('children', $meta);
    }

    public function testBundleMetadataContainsCorrectBundleName(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_layout.bundle_metadata');
        self::assertIsArray($meta);
        self::assertSame('SuluBlockLayoutBundle', $meta['bundle']);
    }

    public function testBundleMetadataContainsCorrectPackageName(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_layout.bundle_metadata');
        self::assertIsArray($meta);
        self::assertSame('depa/sulu-block-layout', $meta['package']);
    }

    public function testBundleMetadataContainsAtLeastOneBlock(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_layout.bundle_metadata');
        self::assertIsArray($meta);
        self::assertNotEmpty($meta['blocks']);
    }

    public function testBlocksAreSortedAndUnique(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_layout.bundle_metadata');
        self::assertIsArray($meta);
        $blocks = $meta['blocks'];
        $sorted = $blocks;
        sort($sorted);
        self::assertSame($sorted, $blocks, 'blocks must be sorted');
        self::assertSame(array_unique($blocks), $blocks, 'blocks must be unique');
    }

    public function testKnownLayoutBlocksArePresent(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_layout.bundle_metadata');
        self::assertIsArray($meta);

        foreach (['block--layout-faq', 'block--layout-hero', 'block--layout-media-text'] as $expected) {
            self::assertContains($expected, $meta['blocks']);
        }
    }

    public function testChildrenValuesAreArraysOfStrings(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_layout.bundle_metadata');
        self::assertIsArray($meta);

        foreach ($meta['children'] as $parent => $kids) {
            self::assertIsArray($kids, "Children of '{$parent}' must be an array");
            foreach ($kids as $child) {
                self::assertIsString($child);
            }
        }
    }

    public function testLayoutFaqHasChildrenFromXml(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_layout.bundle_metadata');
        self::assertIsArray($meta);

        self::assertArrayHasKey('block--layout-faq', $meta['children']);
        self::assertContains('block--content-title', $meta['children']['block--layout-faq']);
        self::assertContains('block--content-faq', $meta['children']['block--layout-faq']);
    }

    public function testLayoutHeroHasChildrenFromXml(): void
    {
        $this->extension->load([], $this->container);
        $meta = $this->container->getParameter('sulu_block_layout.bundle_metadata');
        self::assertIsArray($meta);

        self::assertArrayHasKey('block--layout-hero', $meta['children']);
        self::assertContains('block--content-text', $meta['children']['block--layout-hero']);
    }
}
