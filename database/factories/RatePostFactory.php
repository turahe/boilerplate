<?php

namespace Database\Factories;

use App\Models\Rate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class RatePostFactory.
 */
class RatePostFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Rate::class;

    /**
     * @return array
     */
    public function definition()
    {
        $user = $this->faker->randomElement(User::pluck('id')->toArray());

        return [
            'customer_id' => $user,
//        'post_id' => mt_rand(1, 100),
            'comment' => $this->faker->sentence,
            'rating' => mt_rand(1, 5),
        ];
    }
}
