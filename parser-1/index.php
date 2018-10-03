<?php
require __DIR__ . '/vendor/autoload.php';

use App\Downloader\Downloader;
use App\Parser\MetaParser;
use App\Parser\Parser;
use App\Parser\TagParser;
use GuzzleHttp\Client;

$parser = new Parser();

$tagParser = new TagParser('p');
$tagParser2 = new TagParser('h2');
$metaParser = new MetaParser();

$parser::setParsers([$tagParser, $tagParser2, $metaParser]);

$downloader = new Downloader(new Client);

$content = $downloader->download('laravel-news.com', 'hi.dn.ua');

foreach ($content as $item) {
    print_r($parser((string)$item));
}
