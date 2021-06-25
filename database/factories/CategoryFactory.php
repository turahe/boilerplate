<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class CategoryFactory.
 */
class CategoryFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Category::class;

    /**
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->randomElement([
            'Gear',
            'Clothing',
            'Shoes',
            'Diapering',
            'Feeding',
            'Bath',
            'Toys',
            'Nursery',
            'Household',
            'Grocery',
        ]);

        return [
            'title' => $title,
            'description' => $this->faker->sentence(mt_rand(10, 20)),
            'fee' => mt_rand(1000, 9999),
            'type' => $this->faker->randomElement(['blog', 'product']),
        ];
    }
}
