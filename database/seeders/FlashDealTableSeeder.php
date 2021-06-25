<?php

namespace Database\Seeders;

use App\Models\FlashDeal;
use App\Models\FlashDealProduct;
use Illuminate\Database\Seeder;

class FlashDealTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FlashDeal::factory(10)->create()->each(function ($flashDeal) {
            $flashDeal->flashProducts()->saveMany(FlashDealProduct::factory(20)->make());
        });
    }
}
