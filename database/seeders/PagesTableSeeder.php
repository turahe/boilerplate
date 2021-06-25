<?php

namespace Database\Seeders;

use App\Models\Post as Page;
use Illuminate\Database\Seeder;

/**
 * Class PagesTableSeeder.
 */
class PagesTableSeeder extends Seeder
{
    /**
     * @var array
     */
    private array  $defaultPage = [
        [
            'title' => 'About Us',
            'file' => 'about.md',
        ],
        [
            'title' => 'Privacy and Policy',
            'file' => 'privacy.md',
        ],
        [
            'title' => 'Syarat dan Ketentuan',
            'file' => 'terms.md',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = array_map(function ($post) {
            return [
                'user_id' => 1,
                'title' => $post['title'],
                'content_raw' => file_get_contents(storage_path("app/seeder/pages/{$post['file']}")),
                'type' => 'page',
                'published_at' => now()->toDateTimeString(),
            ];
        }, $this->defaultPage);

        foreach ($posts as $post) {
            Page::updateOrCreate($post);
        }
    }
}
