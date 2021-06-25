<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

/**
 * Class CategoriesTableSeeder.
 */
class CategoriesTableSeeder extends Seeder
{
    /**
     * @var array
     */
    protected array $defaultCategories = [
        [
            'name' =>  'System',
            'type' => 'page',
            'parent_id' => null,
        ],
        [
            'name' =>  'Online shopping',
            'type' => 'blog',
            'parent_id' => null,
        ],
        [
            'name' =>  'Fashion',
            'type' => 'blog',
            'parent_id' => null,
        ],
        [
            'name' =>  'Personal finance',
            'type' => 'blog',
            'parent_id' => null,
        ],
        [
            'name' =>  'Travel & vacation',
            'type' => 'blog',
            'parent_id' => null,
        ],
        [
            'name' =>  'Lifestyle',
            'type' => 'blog',
            'parent_id' => null,
        ],
        [
            'name' =>  'Technology',
            'type' => 'blog',
            'parent_id' => null,
        ],
    ];

    //grafik, photo, presentation, themes dan script.
    private array $categoriesDefault = [
            [
                'name' =>  'graphic',
                'type' => 'product',
                'parent_id' => null,
                'children' => [
                    [
                        'name' =>  'Print templates',
                        'type' => 'product',
                        'fee' => 400,
                    ],
                    [
                        'name' =>  'Product mockup',
                        'type' => 'product',
                        'fee' => 500,
                    ],
                    [
                        'name' =>  'Website',
                        'type' => 'product',
                        'fee' => 300,
                    ],
                    [
                        'name' =>  'Ux and UI kits',
                        'type' => 'product',
                        'fee' => 600,
                    ],
                ],
            ],
            [
                'name' =>  'photo',
                'type' => 'product',
                'parent_id' => null,
                'fee' => 200,

            ],
            [
                'name' =>  'presentation',
                'type' => 'product',
                'parent_id' => null,
                'fee' => 500,

                'children' => [
                    [
                        'name' =>  'Keynotes',
                        'type' => 'product',
                        'fee' => 300,
                    ],
                    [
                        'name' =>  'Power point',
                        'type' => 'product',
                        'fee' => 200,
                    ],
                    [
                        'name' =>  'Google Slide',
                        'type' => 'product',
                        'fee' => 100,
                    ],
                ],
            ],
            [
                'name' =>  'themes',
                'type' => 'product',
                'parent_id' => null,
            ],
            [
                'name' =>  'script',
                'type' => 'product',
                'parent_id' => null,
                'children' => [
                    [
                        'name' =>  'PHP Script',
                        'type' => 'product',
                        'fee' => 1000,
                    ],
                    [
                        'name' =>  'HTML',
                        'type' => 'product',
                        'fee' => 100,
                    ],
                ],
            ],
        ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
        Category::truncate();

//        $categories = array_merge($this->defaultCategories, $this->graphicDefault);

        $data = array_map(function ($category) {
            return [
                'title' => $category['name'],
                'description' => $category['name'],
                'parent_id' => $category['parent_id'] ?? null,
                'type' => $category['type'],
            ];
        }, $this->defaultCategories);

        foreach ($data as $category) {
            Category::updateOrCreate($category);
        }

//        $this->productsGoogleCategories();

        foreach ($this->categoriesDefault as $index => $parent) {
            $p = Category::updateOrCreate([
                'parent_id' => null,
                'title' => $parent['name'],
                'description' => $parent['description'] ?? null,
                'type' => 'product',
                'fee' => $parent['fee'] ?? null,
            ]);

            if (! empty($parent['children'])) {
                foreach ($parent['children'] as $cat) {
                    Category::updateOrCreate([
                        'parent_id' => $p->id,
                        'title' => $cat['name'],
                        'description' => $cat['description'] ?? null,
                        'type' => 'product',
                        'fee' => $cat['fee'] ?? null,
                    ]);
                }
            }
        }

//        if (config('app.name') == 'grafiko') {
//            foreach ($data as $category) {
//                Category::updateOrCreate($category);
//            }
//        }

//

        \Schema::enableForeignKeyConstraints();
    }

    protected function productsGoogleCategories()
    {
        $file = storage_path('data/google_products_categories.json');

        $data_types = json_decode(file_get_contents($file), true);
        $google_products_categories = array_map(function ($category) {
            return [
                'title' => $category['title'],
                'parent_id' => $category['parent_id'] ?? null,
                'type' => 'product',
            ];
        }, $data_types);

        foreach ($google_products_categories as $category) {
            Category::updateOrCreate($category);
        }
    }
}
