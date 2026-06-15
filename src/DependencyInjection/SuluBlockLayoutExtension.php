<?php

declare(strict_types=1);

namespace Depa\SuluBlockLayoutBundle\DependencyInjection;

use Depa\SuluBlockHelperBundle\DependencyInjection\AbstractBlockExtension;

class SuluBlockLayoutExtension extends AbstractBlockExtension
{
    protected function getBundleName(): string
    {
        return 'SuluBlockLayoutBundle';
    }

    protected function getPackageName(): string
    {
        return 'depa/sulu-block-layout';
    }

    protected function getMetadataParameterName(): string
    {
        return 'sulu_block_layout.bundle_metadata';
    }

    protected function getSuluAdminTemplateKey(): string
    {
        return 'sulu_block_layout';
    }
}
