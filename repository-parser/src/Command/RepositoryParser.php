<?php

namespace App\Command;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use ZipArchive;

class RepositoryParser extends Command
{
    const DOWNLOAD_PATH = 'storage';

    /** @var array */
    protected $urls;

    /** @var OutputInteface */
    protected $output;

    protected function configure() : void
    {
        $this->setName('parseMethodNames')
             ->setDescription('Parse names all public methods')
             ->setHelp('Parse names whith public repositories');

        $this->addArgument('url', InputArgument::IS_ARRAY, 'List of urls `profileName/repository`');
    }

    protected function execute(InputInterface $input, OutputInterface $output) : void
    {
        $this->output = $output;

        $this->urls = $input->getArgument('url');

        $this->repositoryDownload();

        $files = $this->getFilesFromDir(static::DOWNLOAD_PATH);

        $this->parseFiles($files);
    }

    protected function getClient() : ClientInterface
    {
        return new Client;
    }

    protected function repositoryDownload() : void
    {
        foreach ($this->urls as $shortUrl) {
            $url  = 'http://github.com/' . $shortUrl . '/archive/master.zip';

            $response = $this->getClient()->request('get', $url, [
                'progress' => [$this, 'onProgress']
            ]);

            if (!file_exists(static::DOWNLOAD_PATH)) {
                mkdir(static::DOWNLOAD_PATH);
            }

            $filePath = $this->getFilePath($shortUrl);

            file_put_contents($filePath, $response->getBody());

            $delete = $this->unZip($filePath);

            if ($delete) {
                unlink($filePath);
            }
        }
    }

    protected function getFilePath($url) : string
    {
        return static::DOWNLOAD_PATH . substr($url, strpos($url, '/')) . '.zip';
    }

    protected function unZip($filePath) : bool
    {
        $zip = new ZipArchive;

        $zip->open($filePath);

        $delete = $zip->extractTo(static::DOWNLOAD_PATH);

        $zip->close();

        return $delete;
    }

    public function onProgress(int $total, int $downloaded) : void
    {
        if ($total <= 0) {
            return;
        }

        $maxValue = 100;
        $currentValue = 100 / $total * $downloaded;

        if (!$this->progressBar) {
            $this->progressBar = $this->createProgressBar($maxValue);
        }

        $this->progressBar->setProgress($currentValue);

        if ($currentValue == $maxValue) {
            $this->output->writeln(PHP_EOL);
        }
    }

    protected function createProgressBar(int $max) : ProgressBar
    {
        $bar = new ProgressBar($this->output, $max);

        $bar->setBarCharacter('<fg=green>·</>');
        $bar->setEmptyBarCharacter('<fg=red>·</>');
        $bar->setProgressCharacter('<fg=green>ᗧ</>');
        $bar->setFormat("%current:8s%/%max:-8s% %bar% %percent:5s%% %elapsed:7s%/%estimated:-7s% %memory%");

        return $bar;
    }

    protected function getFilesFromDir(string $path) : Finder
    {
        $finder = new Finder;
        
        return $finder->in($path . '/')->files()->name('*.php');
    }

    protected function parseFiles(Finder $files) : void
    {
        foreach ($files as $file) {
            $path = $file->getRelativePathname();
            $content = $file->getContents();
            $methodsList = $this->parsePublicMethods($content);

            if (!count($methodsList)) {
                continue;
            }

            $this->output->writeln($path);

            foreach ($methodsList as $method) {
                $this->output->writeln("\t" . $method);
            }
        }
    }

    protected function parsePublicMethods(string $content) : array
    {
        $pattern = '/(?P<method>((a|s).*)?public([\w\s]*)?function\s[\w]+\([^)]*\).*)/';

        preg_match_all($pattern, $content, $matches);

        return $matches['method'];
    }
}
