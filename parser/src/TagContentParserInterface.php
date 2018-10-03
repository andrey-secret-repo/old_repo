<?php

namespace App;

interface TagContentParserInterface
{
    public function getTagContent(string $tag): array;
}