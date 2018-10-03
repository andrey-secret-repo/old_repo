<?php

namespace App;

use SebastianBergmann\Timer\RuntimeException;

class Parser implements MetaTagParserInterface, TagContentParserInterface
{
    protected const META_TAG_PATTERN = '/\<meta.*"(?P<props>.*)".*"(?P<values>.*)"[^>]*>/';

    protected const TAG_PATTERN = '/<%s[^>]*>(?P<value>.*)<\/%s>/';

    /** @var string */
    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getMetaTags(): array
    {
        preg_match_all(self::META_TAG_PATTERN, $this->content, $matches);

        ['props' => $matches, 'values' => $values] = $matches;

        return $this->combine($matches, $values);
    }

    public function getTagContent(string $tag): array
    {
        preg_match_all(sprintf(self::TAG_PATTERN, $tag, $tag), $this->content, $matches);

        return $matches['value'];
    }

    protected function combine(array $props, array $values): array
    {
        if (count($props) < count($values)) {
            $this->TheNumberOfPropsIsLessThanTheNumberOfValues($props, $values);
        }

        $values = array_pad($values, count($props), null);

        return array_combine($props, $values);
    }

    protected function TheNumberOfPropsIsLessThanTheNumberOfValues(array $props, array $values): RuntimeException
    {
        return new RuntimeException(sprintf(
            'The number of props is less than the number of values. Props [`%s`]. Values [`%s`]',
            implode(',', $props),
            implode(',', $values)
        ));
    }
}