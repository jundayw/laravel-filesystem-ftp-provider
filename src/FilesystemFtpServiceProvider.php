<?php

namespace Jundayw\LaravelFilesystemFtpProvider;

use Jundayw\LaravelFilesystemFtpProvider\Ftp;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;

class FilesystemFtpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('ftp',function($app, $config){
            $ftp = new Ftp($config);
            return tap(new Filesystem($ftp,$config),function($filesystem) use ($ftp){
                $ftp->adapt($filesystem);
            });
        });
    }
}
