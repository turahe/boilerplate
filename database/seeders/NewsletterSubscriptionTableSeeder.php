<?php

namespace Database\Seeders;

use App\Models\NewsletterSubscription;
use Illuminate\Database\Seeder;

/**
 * Class NewsletterSubscriptionTableSeeder.
 */
class NewsletterSubscriptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsletterSubscription::factory(100)->create();
    }
}
