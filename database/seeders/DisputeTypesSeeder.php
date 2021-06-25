<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisputeTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Counterfeit goods', 'Customs problem', 'Damaged goods', 'Did not receive goods', 'Problems with the accessories', 'Product not as described', 'Quality not good', 'Quantity shortage', 'Shipping address not correct', 'Shipping method'];
        $data = array_map(function ($type) {
            return [
                'detail' => $type,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }, $types);

        DB::table('dispute_types')->insert($data);
    }
}
