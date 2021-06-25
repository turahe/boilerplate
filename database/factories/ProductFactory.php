<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ProductFactory.
 */
class ProductFactory extends Factory
{
    /**
     * {@inheritdoc}
     */
    protected $model = Product::class;

    /**
     * {@inheritdoc}
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence(6, 2);
        $category = $this->faker->randomElement(\DB::table('categories')->where('type', 'product')->pluck('id')->toArray());
        $vendor = $this->faker->randomElement(\DB::table('vendors')->where('type', 'vendor')->pluck('id')->toArray());

        return [
            'vendor_id' => $vendor, //factory(\App\Models\Products::class)->create()->id,
            'category_id' => $category,
            'title' => $title,
            'subtitle' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'content_raw' =>  implode("\n\n", $this->faker->paragraphs(mt_rand(7, 16))),
            'published_at' => $this->faker->dateTimeBetween('-1 Month', '+3 days'),
            'type' => $this->faker->randomElement(['digital', 'default']),
        ];
    }
}
