<?php namespace CommonMark\Extension\Metadata;

use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\ExtensionInterface;

final class MetadataExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment
            ->addBlockStartParser(MetadataParser::createBlockStartParser(), 100)
            ->addRenderer(MetadataBlock::class, new MetadataRenderer, -100);
    }
}
