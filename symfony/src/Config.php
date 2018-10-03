<?php

namespace App;

use App\Services\DownloadRepositories;
use App\Services\ExtractZip;
use App\Services\MethodsParser;

class Config
{
    protected $path;

    public function setPath(string $path)
    {
        $this->path = $path;
    }

    public function getZipExtract()
    {
        return new ExtractZip($this->path);
    }

    public function getMethodsParser()
    {
        return new MethodsParser($this->path);
    }

    public function getRepositoriesDownloader()
    {
        return new DownloadRepositories($this->path);
    }
}