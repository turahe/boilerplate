<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class CommentFactory.
 */
class CommentFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Comment::class;

    /**
     * @return array
     */
    public function definition()
    {
        $user = $this->faker->randomElement(\DB::table('users')->pluck('id')->toArray());

        return [
            'user_id' => $user, //factory(\App\Models\Products::class)->create()->id,
            'title' => $this->faker->sentence,
            'content' => Str::limit($this->faker->paragraph(mt_rand(3, 5))),
            'published_at' => $this->faker->dateTimeBetween('-1 Month', '+3 days'),
            'type' => $this->faker->randomElement(['comment', 'review', 'testimony', 'faq']),
        ];
    }
}
