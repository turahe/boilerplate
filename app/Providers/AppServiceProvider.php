<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (class_exists('Turahe\Counters\CountersServiceProvider')) {
            $this->app->register(\Turahe\Counters\CountersServiceProvider::class);
        }
        if (class_exists('Turahe\Wallet\WalletServiceProvider')) {
            $this->app->register(\Turahe\Wallet\WalletServiceProvider::class);
        }
        if (class_exists('Turahe\Master\MasterServiceProvider')) {
            $this->app->register(\Turahe\Master\MasterServiceProvider::class);
        }
        if (class_exists('Turahe\Master\MasterServiceProvider')) {
            $this->app->register(\Turahe\Likeable\LikeableServiceProvider::class);
        }

    }

    /**
     * get installer if apps not installed.
     */
    private function installed()
    {
        $name = config('app.unique_id').'_installed';
        $filename = storage_path('app'.DIRECTORY_SEPARATOR.$name);
        if (file_exists($filename) && class_exists('Turahe\LaravelInstaller\Providers\LaravelInstallerServiceProvider')) {
            $this->app->register(\Turahe\LaravelInstaller\Providers\LaravelInstallerServiceProvider::class);
        }

        return url('welcome');
    }
}
