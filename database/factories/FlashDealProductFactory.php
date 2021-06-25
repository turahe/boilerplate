<?php

namespace Database\Factories;

use App\Models\FlashDealProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlashDealProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FlashDealProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product = $this->faker->randomElement(\DB::table('products')->pluck('id')->toArray());

        return [
            'product_id' => $product,
            'discount' => 10,
            'discount_type' => 'percent',
        ];
    }
}
