<?php

namespace Tests;

use App\Downloader;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class DownloaderTest extends TestCase
{
    protected $client;

    public function test_download()
    {
        $expectedContent = ['1', '2', '3', '4'];

        $client = $this->getClient($expectedContent);

        $downloader = new Downloader($client);

        $givenContents = iterator_to_array($downloader->download(['/', '/', '/', '/']));

        $this->assertEquals($givenContents, $expectedContent);
    }

    public function getClient(array $contents): Client
    {
        $responses = array_map(function (string $content) {
            return new Response(200, [], $content);
        }, $contents);

        $handler = new MockHandler($responses);

        return new Client(compact('handler'));
    }
}