<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

/**
 * Class PostsTableSeeder.
 */
class PostsTableSeeder extends Seeder
{
    /**
     * @var array|string[][]
     */
    private array $defaultSlide = [
        [
            'title' => 'Women Sportswear Sale',
            'subtitle' => 'Hurry up! Limited time offer',
            'content' => 'Sneakers, Keds, Sweatshirts, Hoodies &amp; much more...',
            'type' => 'slide',
            'file' => 'slider-01.jpg',
        ],
        [
            'title' => 'Huge Summer Collection',
            'subtitle' => 'Has just arrived!',
            'content' => 'Swimwear, Tops, Shorts, Sunglasses &amp; much more...',
            'type' => 'slide',
            'file' => 'slider-02.jpg',
        ],
        [
            'title' => 'New Men\'s Accessories',
            'subtitle' => 'Complete your look with',
            'content' => 'Hats &amp; Caps, Sunglasses, Bags &amp; much more...',
            'type' => 'slide',
            'file' => 'slider-03.jpg',
        ],
        [
            'title' => 'Converse All Star on Sale',
            'subtitle' => 'Hurry up! Limited time offer',
            'content' => 'Shop Now',
            'type' => 'banner',
            'file' => 'banner.jpg',
        ],
        [
            'title' => 'Your Add Banner Here',
            'subtitle' => 'Hurry up to reserve your spot',
            'content' => 'Contact Us',
            'type' => 'add',
            'file' => 'banner-bg.jpg',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
        Post::truncate();
        foreach ($this->defaultSlide as $content) {
            $post = Post::updateOrCreate([
                'category_id' => 1,
                'user_id' => 1,
                'title' => $content['title'],
                'content_raw' => $content['content'],
                'type' => $content['type'],
                'published_at' => now()->toDateTimeString(),
            ]);
            $post->addMediaFromUrl('https://picsum.photos/id/'.mt_rand(1, 100).'/1024/1024')
                ->toMediaCollection('image');

            $post->addCounter('number_of_views'); // to add the record to countrable table
        }
    }
}
