<?php

namespace Tests;

use App\Parser;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    public function test_get_tag_content()
    {
        $expectedContent = '111111111';

        $html = "<p>" . $expectedContent . "</p>";

        $parser = new Parser($html);

        $result = $parser->getTagContent('p');

        $this->assertSame($expectedContent, $result[0]);
    }

    public function test_get_meta_tag()
    {

        $meta = "<meta name=\"viewport\" content=\"content\">";

        $parser = new Parser($meta);

        $result = $parser->getMetaTags();

        $this->assertSame('content', $result['viewport']);
    }
}