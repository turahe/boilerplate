<?php

namespace Database\Factories;

use App\Models\FlashDeal;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlashDealFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FlashDeal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'start_date' => $this->faker->date('Y-m-d', 'now'),
            'end_date' => $this->faker->date('Y-m-d'),
        ];
    }
}
