<?php

namespace Database\Factories;

use App\Models\Products\Variant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Variant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'condition' => $this->faker->randomElement(['micro_stock']),
            'weight' => $this->faker->numberBetween(99, 999),
            'sku' => 'INV-'.$this->faker->numberBetween(999, 9999),
            'barcode' => $this->faker->iso8601,
            'stock' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->numberBetween(9, 999) * 1000,
            'is_default' => $this->faker->boolean,
            'type' => $this->faker->randomElement(['regular', 'extended']),
        ];
    }
}
