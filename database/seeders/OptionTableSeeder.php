<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bank_gateway = [
            'enable_bank_transfer' => true,
            'bank_name' => 'BCA',
            'bank_swift_code' => null,
            'account_number' => '123443423',
            'branch_name' => 'KOPO',
            'branch_address' => 'Jalan kopo no 3',
            'account_name' => 'Circle Creative',
            'iban' => 'IBM',
        ];

        $midtrans = [
            'enable' => true,
            'test_mode' => true,
            'id_merchant' => 'G624028022',
            'client_key' => 'SB-Mid-client-OhuBYYdphvdOhY1L',
            'server_Key' => 'SB-Mid-server-Sx1oMaKFdO1FHdTj2VihS_fI',
        ];
        $stripe = [
            'enable' => false,
            'test_mode' => true,
            'test_secret_key' => 'sk_test_tJeAdA1KbhiYV8I8bfPmJcOL',
            'test_publishable_key' => 'pk_test_P3TFmKrvT7l29Zpyy1f4pwk8',
            'live_secret_key' => null,
            'live_publishable_key' => null,
        ];

        $paypal = [
            'receiver_email' => 'admin@circle-creative.com',
            'paypal' => false,
            'paypal_sandbox' => true,
        ];
        $payment_gateway_bank_transfer = [
            'enabled' => true,
            'title' => 'Direct Bank Transfer',
            'description' => 'Pay via direct bank transfer to process your order',
            'instructions' => 'Please transfer your fund using following Bank Account\\r\\n\\r\\nBank Name: Bank Asia\\r\\nBranch: Mirpur circle 10\\r\\nA\\/C No: 079878765545354',
            'gateway_save_btn' => null,
        ];
        $payment_gateway_cod = [
            'enabled' => true,
            'title' => 'Cash on delivery',
            'description' => 'Pay upon delivery',
            'instructions' => 'Pay upon delivery to the delivery man',
            'gateway_save_btn' => null,
        ];
        $withdraw_method = [
            'bank_transfer' => [
                'enable' => true,
                'min_withdraw_amount' => '100',
                'notes' => 'Please note that it takes approximately 2 to 7 days to process your withdraw via bank transfer. Sometimes it may take longer. If you do not receive withdrawal after 7 days, please contact our customer support. Updated',
            ],
            'echeck' => [
                'enable' => true,
                'min_withdraw_amount' => '50',
            ],
            'paypal' => [
                'enable' => true,
                'min_withdraw_amount' => '50',
            ],
        ];

        $cookie_alert = [
            'enable' => true,
            'message' => 'By using Toko you accept our cookies and agree to our privacy policy, including cookie policy. {privacy_policy_url}',
        ];
        $social_login = [
            'enable' => true,
            'facebook' => [
                'enable' => true,
                'app_id' => '292155035510814',
                'app_secret' => 'de1a21d48afe669dda21626fdf638832',
            ],
            'google' => [
                'enable' => true,
                'client_id' => '586033023574-3m025n2jei2eldgdqf7ic2r7rh58oj86.apps.googleusercontent.com',
                'client_secret' => 'Pd6fUp5FFmXUt-M0Prdc2fFy',
            ],
            'twitter' => [
                'enable' => true,
                'consumer_key' => 'iXy8T2reBWP42aD60rXdtUf8R',
                'consumer_secret' => 'SEYSr2AFVaVfH56xPZerEZxBW7gGgZOE2CT8jdoq32BbuL7Zv3',
            ],
            'linkedin' => [
                'enable' => true,
                'client_id' => '86iampeb7c62rw',
                'client_secret' => 'Gyb9naxKvOR6wM8i',
            ],
        ];

        $readtime = [
            'abbreviate_time_measurements' => false,
            'omit_seconds' => true,
            'time_only' => false,
            'words_per_minute' => 230,
        ];

        $options = [
            'default_storage' => config('filesystems.default'),
            'date_format' => 'd/m/Y',
            'time_format' => 'H:i',
            'site_name' => config('site.name'),
            'site_title' => config('site.title'),
            'name' => config('site.name'),
            'short_name' => config('site.name'),
            'email_address' => 'wachid@example.com',
            'phone' => '+6285225440150',
            'default_timezone' => config('app.timezone'),
            'date_format_custom' => 'd/m/Y',
            'time_format_custom' => 'H:i',
            'start_url' => config('app.url'),
            'background_color' => '#ffffff',
            'theme_color' => '#000000',
            'display' => 'standalone',
            'orientation' => 'any',
            'status_bar' => 'black',

            'title' => config('site.name'),
            'subtitle' => config('site.subtitle'),
            'keywords' => config('site.keywords'),
            'description' => config('site.description'),

            // ReadTime
            'read_time' => json_encode($readtime),
            // Google analytics
            'google_analytics' => json_encode(config('analytics')),
            'rajaongkir' => json_encode(config('rajaongkir')),

            'midtrans' => json_encode($midtrans),

            'stripe' => json_encode($stripe),

            'paypal' => json_encode($paypal),
            'current_theme' => 'default',
            'copyright_text' => '[copyright_sign] [year] [site_name], All rights reserved.',
            'currency_position' => 'left',
            'currency_sign' => 'IDR',
            'currency_country' => 'id_ID',
            'payment_gateway_direct_bank_transfer' => json_encode($payment_gateway_bank_transfer),
            'payment_gateway_cod' => json_encode($payment_gateway_cod),
            'allowed_file_types' => 'jpeg,png,jpg,pdf,zip,doc,docx,xls,ppt,mp4',
            'is_preview' => true,
            'admin_share' => 20,
            'instructor_share' => 80,
            'charge_fees_name' => 'Payment gateway charge',
            'charge_fees_amount' => 4,
            'charge_fees_type' => 'percent',
            'enable_charge_fees' => true,
            'enable_instructors_earning' => true,
            'bank_gateway' => json_encode($bank_gateway),
            'enable_offline_payment' => true,
            'site_url' => config('app.url'),
            'withdraw_methods' => json_encode($withdraw_method),
            'site_logo' => null,
            'terms_of_use_page' => 1,
            'privacy_policy_page' => 4,
            'about_us_page' => 3,

            'payout_fee' => 10000,
            'marketplace_fee_newbie' => '40%',
            'marketplace_fee_power_author' => '30%',
            'marketplace_fee_elite_author' => '20%',

            'cookie' => json_encode($cookie_alert),
            'social_login' => json_encode($social_login),
            'social_media' => json_encode(config('site.socials')),
        ];

        $newOptions = [];
        foreach ($options as $key => $value) {
            $newOptions[] = [
                'option_key' => $key,
                'option_value' => $value,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }
        Option::truncate();
        Option::insert($newOptions);
    }
}
