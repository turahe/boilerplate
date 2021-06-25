<?php
/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @modified    6/25/21, 10:26 AM
 * @author         Nur Wachid
 * @copyright      Copyright (c) 2021.
 */

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
        $this->registerService();

    }

    private function registerService()
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
        if (class_exists('Turahe\Store\StoreServiceProvider')) {
            $this->app->register(\Turahe\Store\StoreServiceProvider::class);
        }
    }

    /**
     * get installer if apps not installed.
     */
    private function installed()
    {
        $name = config('app.unique_id').'_installed';
        $filename = storage_path('app'.DIRECTORY_SEPARATOR.$name);
        if (! file_exists($filename) && class_exists('Turahe\LaravelInstaller\Providers\LaravelInstallerServiceProvider')) {
            $this->app->register(\Turahe\LaravelInstaller\Providers\LaravelInstallerServiceProvider::class);
        }

        return url('welcome');
    }
}
