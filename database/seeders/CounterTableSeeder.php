<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Turahe\Counters\Models\Counter;

class CounterTableSeeder extends Seeder
{
    private array $defaultCounter = [
        [
            'key' => 'number_of_product_download',
            'name' => 'Product Downloads',
        ],
        [
            'key' => 'number_of_views',
            'name' => 'Views',
        ],
        [
            'key' => 'number_of_user_download',
            'name' => 'User downloads',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->defaultCounter as $counter) {
            Counter::updateOrCreate([
                'key' => $counter['key'],
                'name' => $counter['name'],
            ]);
        }
    }
}
