<?php

namespace Jundayw\LaravelFilesystemFtpProvider;

use League\Flysystem\Adapter\Ftp as FtpAdapter;

class Ftp extends FtpAdapter
{
    public $adapt;

    public function getUrl($path)
    {
        $config = $this->adapt->getConfig();

        if ($config->has('url')) {
            return $this->concatPathToUrl($config->get('url'), $path);
        }

        return $path;
    }

    public function adapt($adapt)
    {
        $this->adapt = $adapt;
    }

    protected function concatPathToUrl($url, $path)
    {
        return rtrim($url, '/') . '/' . ltrim($path, '/');
    }
}