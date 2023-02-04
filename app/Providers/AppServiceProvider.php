<?php

namespace App\Providers;

use App\Repositories\RBC\Log;
use App\Repositories\RBC\Rss;
use App\Repositories\RBC\Storage;
use App\Services\RSS\RBC\RBC;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $rbc = new RBC(
            new Rss(env('RSS_RBC_LINK')),
            new Storage(),
            new Log()
        );
        $this->app->bind(RBC::class, function($app) use ($rbc) {
            return $rbc;
        });
    }

    public function boot()
    {

    }
}
