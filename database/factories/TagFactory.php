<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class TagFactory.
 */
class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $word = $$this->faker->unique()->word;

        return [
            'tag' => $word,
            'title' => ucfirst($word),
            'subtitle' => $this->faker->sentence,
            'description' => "Meta for $word",
        ];
    }
}
