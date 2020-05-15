<?php

namespace App\Providers;

use App\Services\PaynowService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PaynowService::class, function ($app) {
            return new PaynowService(config('paynow.id'), config('paynow.key'));
        });
    }
}
