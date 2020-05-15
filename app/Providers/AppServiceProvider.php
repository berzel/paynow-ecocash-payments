<?php

namespace App\Providers;

use App\ValueObjects\PaynowID;
use App\Services\PaynowService;
use App\ValueObjects\PaynowKey;
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
            $id = new PaynowID(config('paynow.id'));
            $key = new PaynowKey(config('paynow.key'));
            
            return new PaynowService($id, $key);
        });
    }
}
