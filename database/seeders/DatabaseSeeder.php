<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            OptionTableSeeder::class,
            CounterTableSeeder::class,
            PlansTableSeeder::class,
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            PostsTableSeeder::class,
            PagesTableSeeder::class,
            BlogsTableSeeder::class,

            ProductsTableSeeder::class,
//            FlashDealTableSeeder::class,
            WithdrawTableSeeder::class,
//            SettingsTableSeeder::class,
            ContactsUsTableSeeder::class,
            NewsletterSubscriptionTableSeeder::class,
        ]);
    }
}
