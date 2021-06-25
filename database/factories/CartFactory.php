<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cart::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $vendor = $this->faker->randomElement(Vendor::where('type', 'shop')->pluck('id')->toArray());
        $customer = $this->faker->randomElement(User::pluck('id')->toArray());

        return [
            'vendor_id' => $vendor,
            'customer_id' => $customer,
            'ip_address' => $this->faker->ipv4,
            'ship_to' => '',
            'shipping_zone_id' => '',
            'shipping_rate_id' => '',
            'packaging_id' => '',
            'tax_rate' => '',
            'item_count' => '',
            'quantity' => '',
            'total' => '',
            'discount' => '',
            'shipping' => '',
            'packaging' => '',
            'handling' => '',
            'taxes' => '',
            'grand_total' => '',
            'shipping_weight' => '',
            'shipping_address' => '',
            'billing_address' => '',
            'coupon_id' => '',
            'payment_method_id' => '',
            'payment_status' => '',
            'message_to_customer' => '',
            'admin_note' => '',
        ];
    }
}
