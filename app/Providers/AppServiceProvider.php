<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client; // <-- TAMBAHKAN INI

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    if (env('APP_ENV') === 'local') {
        $this->app->extend(Client::class, function ($client, $app) {
            return new Client([
                'verify' => false, // Opsi VERIFY=FALSE diaktifkan
                'handler' => $client->getConfig('handler'),
            ]);
        });
    }
    }
}
