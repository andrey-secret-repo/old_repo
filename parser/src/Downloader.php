<?php

namespace App;

use Generator;
use GuzzleHttp\ClientInterface;

class Downloader implements DownloaderInterface
{
    /** @var ClientInterface */
    protected $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function download(array $urls): Generator
    {
        foreach ($urls as $url) {
            $response = $this->client->request('GET', $url);

            yield $response->getBody();
        }
    }
}