<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Rate;
use Illuminate\Database\Seeder;

/**
 * Class BlogsTableSeeder.
 */
class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Turahe\Likeable\Exceptions\LikerNotDefinedException
     * @return void
     */
    public function run()
    {
        Post::factory(25)->create()->each(function (Post $post) {
            $post->addMediaFromUrl('https://picsum.photos/id/'.mt_rand(1, 50).'/1024/1024')
                ->preservingOriginal()
                ->toMediaCollection();

            $post->comments()->saveMany(Comment::factory(mt_rand(1, 10))->make(['type' => 'comment']));
            $post->attachTags(['Fashion', 'Personal', 'Finance', 'Travel', 'Vacation', 'LifeStyle', 'Technology'], 'blog');
            for ($i = 1; $i < 20; $i++) {
                $post->like(mt_rand(1, 10));
                $post->dislike(mt_rand(1, 10));
            }
            $post->ratings()->saveMany(Rate::factory(3)->make());
            $post->like(mt_rand(1, 10));
            $post->dislike(mt_rand(1, 10));
        });
    }
}
