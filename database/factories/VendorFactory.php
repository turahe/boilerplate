<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * Class ShopFactory.
 */
class VendorFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Vendor::class;

    /**
     * @return array
     */
    public function definition()
    {
        $user = $this->faker->randomElement(DB::table('users')->pluck('id')->toArray());

        return [
            'owner_id' => $user,
            'name' => $this->faker->company,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'description' => $this->faker->sentences(3, true),
            'domain' => $this->faker->unique()->domainName,
            'type' => $this->faker->randomElement(['creditor', 'vendor']),
        ];
    }
}
