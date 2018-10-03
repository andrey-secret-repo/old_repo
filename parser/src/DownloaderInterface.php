<?php

namespace App;

use Generator;

interface DownloaderInterface
{
    public function download(array $urls): Generator;
}