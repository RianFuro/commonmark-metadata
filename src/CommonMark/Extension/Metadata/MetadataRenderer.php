<?php

namespace CommonMark\Extension\Metadata;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

class MetadataRenderer implements NodeRendererInterface
{

    public function render(Node $node, ChildNodeRendererInterface $childRenderer): string
    {
        return '';
    }
}
