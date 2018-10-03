<?php

use App\Parser\MetaParser;
use App\Parser\Parser;
use App\Parser\TagParser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /** @var ParserInterface */
    protected $parser;

    protected function setUp()
    {
        parent::setUp();

        $this->parser = new Parser;

    }

    /** @test */
    public function it_returns_meta_tag_and_tag_content()
    {
        $content = '
        <meta name="meta1" content="meta-content">
        <div>
            <p>content1</p>
            <p>content2</p>
         </div>
        ';

        $expected = [
            [
                'meta1' => 'meta-content'
            ],
            [
                'content1',
                'content2'
            ]
        ];

        $parsers = [new MetaParser, new TagParser('p')];

        $this->parser::setParsers($parsers);

        $this->assertSame($expected, $this->parser->__invoke($content));

    }
}