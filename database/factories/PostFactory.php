<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class BlogFactory.
 */
class PostFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Post::class;

    /**
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique()->sentence(3, 2);
        $category = $this->faker->randomElement(Category::where('type', 'blog')->pluck('id')->toArray());
        $user = $this->faker->randomElement(User::pluck('id')->toArray());

        return [
            'user_id' => $user, //factory(\App\Models\Products::class)->create()->id,
            'category_id' => $category,
            'title' => $title,
            'subtitle' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(3),
            'content_raw' =>  implode("\n\n", $this->faker->paragraphs(mt_rand(7, 16))),
            'is_sticky' => $this->faker->boolean,
            'published_at' => $this->faker->dateTimeBetween('-1 Month', '+3 days'),
            'type' => 'blog',

        ];
    }
}
