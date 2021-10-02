<?php namespace CommonMark\Extension\Metadata;

use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Parser\Block\AbstractBlockContinueParser;
use League\CommonMark\Parser\Block\BlockContinue;
use League\CommonMark\Parser\Block\BlockContinueParserInterface;
use League\CommonMark\Parser\Block\BlockStart;
use League\CommonMark\Parser\Block\BlockStartParserInterface;
use League\CommonMark\Parser\Block\DocumentBlockParser;
use League\CommonMark\Parser\Cursor;
use League\CommonMark\Parser\MarkdownParserStateInterface;

final class MetadataParser extends AbstractBlockContinueParser
{
    private MetadataBlock $block;

    public function __construct()
    {
        $this->block = new MetadataBlock;
    }

    public static function createBlockStartParser(): BlockStartParserInterface
    {
        return new class implements BlockStartParserInterface
        {
            public function tryStart(Cursor $cursor, MarkdownParserStateInterface $parserState): ?BlockStart
            {
                if (
                    // Is this the best method to check if we are at the start of the document?
                    $parserState->getLastMatchedBlockParser() instanceof DocumentBlockParser &&
                    $cursor->getLine() === '---'
                ) return BlockStart::of(new MetadataParser);
                else return BlockStart::none();
            }
        };
    }

    public function getBlock(): AbstractBlock
    {
        return $this->block;
    }

    public function tryContinue(Cursor $cursor, BlockContinueParserInterface $activeBlockParser): ?BlockContinue
    {
        $line = $cursor->getLine();
        if ($line === '---') return BlockContinue::finished();

        [$name, $value] = explode(':', $line);
        $this->block->data->set($name, $value);

        return BlockContinue::at($cursor);
    }
}

