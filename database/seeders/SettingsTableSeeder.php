<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::setMany([
            'active_theme' => 'Storefront',
            'supported_countries' => 'ID',
            'default_country' => 'ID',
            'supported_locales' => ['id', 'en'],
            'default_locale' => 'id',
            'default_timezone' => 'Asia/Jakarta',
            'customer_role' => 2,
            'reviews_enabled' => true,
            'auto_approve_reviews' => true,
            'cookie_bar_enabled' => true,
            'supported_currencies' => ['USD', 'IDR'],
            'default_currency' => 'USD',
            'send_order_invoice_email' => false,
            'store_email' => 'admin@toko.test',
            'newsletter_enabled' => true,
            'search_engine' => 'mysql',
            'local_pickup_cost' => 0,
            'flat_rate_cost' => 0,
        ]);
    }
}
