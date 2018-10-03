<?php
require __DIR__ . '/vendor/autoload.php';

use App\Downloader;
use App\Parser;
use GuzzleHttp\Client;

$arr = ['laravel-news.com', 'kramatorsk.info', 'friend-kramatorsk.store', 'kram-hospital.store'];

$downloader = new Downloader(new Client);

$content = $downloader->download($arr);

foreach ($content as $key => $item) {
    $parser = new Parser($item);
    $result[$key]['meta'] = $parser->getMetaTags();
    $result[$key]['tag'] = $parser->getTagContent('p');
}
var_dump($result);