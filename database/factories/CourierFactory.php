<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Turahe\Master\Models\Courier;

/**
 * Class CourierFactory.
 */
class CourierFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Courier::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'shop_id' => $this->faker->randomElement(\DB::table('vendor')->where('type', 'shop')->pluck('id')->toArray()),
            'tax_id' => $this->faker->randomElement(\DB::table('taxes')->pluck('id')->toArray()),
            'name' => $this->faker->randomElement(['DHL', 'FedEx', 'USP', 'TNT Express', 'USPS', 'YRC', 'DTDC']),
            'tracking_url' => $this->faker->url.'/@',
        ];
    }
}
