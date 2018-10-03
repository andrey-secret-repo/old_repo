<?php

namespace Tests\Unit\Downloader;

use App\Downloader\Downloader;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class DownloaderTest extends TestCase
{
    /** @test */
    public function it_returns_site_body()
    {
        $expectedContent = ['1', '2', '3', '4'];

        $client = $this->getClient($expectedContent);

        $downloader = new Downloader($client);

        $actual = iterator_to_array($downloader->download(...['/', '/', '/', '/']));

        $this->assertSame($expectedContent, $actual);
    }

    public function getClient(array $contents)
    {
        $responses = array_map(function (string $content) {
            return new Response(200, [], $content);
        }, $contents);

        $handler = new MockHandler($responses);

        return new Client(compact('handler'));
    }
}