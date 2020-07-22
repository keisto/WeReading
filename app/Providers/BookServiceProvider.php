<?php

namespace App\Providers;

use App\Http\Client\BookClient;
use Illuminate\Support\ServiceProvider;

class BookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BookClient::class, function () {
            return new BookClient([
                'base_uri' => config('book')['base_uri']
            ]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
