<?php

namespace App\Parser;

class TagParser implements ParserInterface
{
    /** @var string */
    const PATTERN = '/<%s[^>]*>(?P<value>.*)<\/%s>/';

    protected $tag;

    public function __construct(string $tag)
    {
        $this->tag = $tag;
    }

    public function __invoke(string $content)
    {
        preg_match_all(sprintf(self::PATTERN, $this->tag, $this->tag), $content, $matches);

        return $matches['value'];
    }

}