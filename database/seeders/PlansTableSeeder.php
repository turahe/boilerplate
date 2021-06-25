<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Plans\Feature;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
        Plan::truncate();
        Feature::truncate();

        Plan::updateOrCreate([
            'name' => 'Free',
            'description' => 'Joining is risk-free. Cancel your subscription within 30 days and get a full refund. No questions asked.',
            'price' => 0,
            'signup_fee' => 0,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 15,
            'trial_interval' => 'day',
            'currency' => 'IDR',
        ])->features()->saveMany([
            // Create multiple plan features at once
            new Feature(['name' => 'Download', 'description' => 'Download', 'value' => 10, 'order_column' => 1]),
            new Feature(['name' => 'download_per_item', 'description' => 'Download per item',  'value' => 10, 'order_column' => 5]),
        ]);

        Plan::updateOrCreate([
            'name' => 'Single Item',
            'description' => 'Joining is risk-free. Cancel your subscription within 30 days and get a full refund. No questions asked.',
            'price' => 50000,
            'signup_fee' => 1.99,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 15,
            'trial_interval' => 'day',
            'currency' => 'IDR',
        ])->features()->saveMany([
            // Create multiple plan features at once
            new Feature(['name' => 'Download', 'description' => 'Download', 'value' => 100000, 'order_column' => 1]),
            new Feature(['name' => 'download_per_item', 'description' => '', 'value' => 100000, 'order_column' => 5]),
            new Feature(['name' => 'download_duration_time', 'description' => '', 'value' => 30, 'order_column' => 10, 'resettable_period' => 1, 'resettable_interval' => 'month']),
            new Feature(['name' => 'priority_support', 'description' => 'Priority support',  'value' => 'Y', 'order_column' => 15]),
        ]);

        Plan::updateOrCreate([
            'name' => 'All items',
            'description' => 'Joining is risk-free. Cancel your subscription within 30 days and get a full refund. No questions asked.',
            'price' => 750000,
            'signup_fee' => 1.99,
            'invoice_period' => 1,
            'invoice_interval' => 'month',
            'trial_period' => 15,
            'trial_interval' => 'day',
            'currency' => 'IDR',
        ])->features()->saveMany([
            // Create multiple plan features at once
            new Feature(['name' => 'Download', 'description' => 'Download', 'value' => 50, 'order_column' => 1]),
            new Feature(['name' => 'download_per_item', 'description' => 'Download per item', 'value' => 50, 'order_column' => 5]),
            new Feature(['name' => 'download_duration_time', 'description' => 'Download duration time', 'value' => 70, 'order_column' => 10, 'resettable_period' => 1, 'resettable_interval' => 'month']),
            new Feature(['name' => 'priority_support', 'description' => 'Priority support',  'value' => 'Y', 'order_column' => 15]),
        ]);

        Plan::updateOrCreate([
            'name' => 'Single Item',
            'description' => 'Joining is risk-free. Cancel your subscription within 30 days and get a full refund. No questions asked.',
            'price' => 50000,
            'signup_fee' => 1.99,
            'invoice_period' => 1,
            'invoice_interval' => 'yearly',
            'trial_period' => 15,
            'trial_interval' => 'day',
            'currency' => 'IDR',
        ])->features()->saveMany([
            // Create multiple plan features at once
            new Feature(['name' => 'Download', 'description' => 'Download', 'value' => 50, 'order_column' => 1]),
            new Feature(['name' => 'download_per_item', 'description' => 'Download per item', 'value' => 10, 'order_column' => 5]),
            new Feature(['name' => 'download_duration_time', 'description' => 'Download duration time', 'value' => 30, 'order_column' => 10, 'resettable_period' => 1, 'resettable_interval' => 'yearly']),
            new Feature(['name' => 'priority_support', 'description' => 'Priority support',  'value' => 'Y', 'order_column' => 15]),
        ]);

        Plan::updateOrCreate([
            'name' => 'All items',
            'description' => 'Joining is risk-free. Cancel your subscription within 30 days and get a full refund. No questions asked.',
            'price' => 250000,
            'signup_fee' => 1.99,
            'invoice_period' => 1,
            'invoice_interval' => 'yearly',
            'trial_period' => 15,
            'trial_interval' => 'day',
            'currency' => 'IDR',
        ])->features()->saveMany([
            // Create multiple plan features at once
            new Feature(['name' => 'Download', 'description' => 'Download',  'value' => 50, 'order_column' => 1]),
            new Feature(['name' => 'download_per_item', 'description' => 'Download per item', 'value' => 10, 'order_column' => 5]),
            new Feature(['name' => 'download_duration_time', 'description' => 'Download duration time',  'value' => 30, 'order_column' => 10, 'resettable_period' => 1, 'resettable_interval' => 'yearly']),
            new Feature(['name' => 'priority_support', 'description' => 'Priority support',  'value' => 'Y', 'order_column' => 15]),
        ]);
    }
}
