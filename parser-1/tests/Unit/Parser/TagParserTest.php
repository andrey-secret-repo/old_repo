<?php

namespace Tests\Unit\Parser;

use App\Parser\TagParser;
use PHPUnit\Framework\TestCase;

class TagParserTest extends TestCase
{
    /**  @test */
    public function it_returns_the_tag_content()
    {
        $parser = new TagParser('p');

        $expected = ['content1', 'content2'];

        $content = '
    <p>content1</p>
    <p>content2</p>
    ';

        $this->assertSame($expected, $parser($content));
    }
}