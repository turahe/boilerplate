<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Product;
use App\Models\Products\Variant as ProductVariant;
use App\Models\Rate as ProductRate;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @throws \Turahe\Likeable\Exceptions\LikerNotDefinedException
     *@throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileCannotBeAdded
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
        Product::truncate();

        Product::factory(15)->create()->each(function (Product $product) {
            $product->addMediaFromUrl('https://picsum.photos/id/'.mt_rand(1, 50).'/1024/1024')
                ->usingName($product->title)
                ->preservingOriginal()
                ->toMediaCollection('image');
            $product->addMediaFromUrl('https://picsum.photos/id/'.mt_rand(1, 50).'/1024/1024')
                ->usingName($product->title)
                ->preservingOriginal()
                ->toMediaCollection('file_asset');

            $product->reviews()->saveMany(Comment::factory(mt_rand(1, 10))->make(['type' => 'review']));
            $product->faq()->saveMany(Comment::factory(mt_rand(1, 10))->make(['type' => 'faq']));
            $product->reviews()->saveMany(Comment::factory(mt_rand(1, 10))->make(['type' => 'review']));
            for ($i = 1; $i <= 20; $i++) {
                $product->like(mt_rand(1, 10));
            }

            $product->addMeta('features', [
                '25 Illustrations',
                'Bright & Modern Style',
                'Fully Vector',
                'AI, SVG, PNG Sources ',
            ]);

            $product->variants()->save(ProductVariant::factory()->make(['type' => 'regular', 'is_default' => true]));
            $product->variants()->save(ProductVariant::factory()->make(['type' => 'extended', 'is_default' => false]));
            $product->ratings()->saveMany(ProductRate::factory(3)->make());
            $product->like(mt_rand(1, 10));
            $product->dislike(mt_rand(1, 10));
            $product->attachTags(['best product', 'best seller', 'cheap', 'the best of the year'], 'product');
            $product->attachTags(['photoshop', 'illustrator', 'corel', 'acrobat', 'excel', 'word'], 'file_type');
        });
    }

//        foreach (Product::all() as $product) {
//            foreach (glob($file->getPath().'/*') as $image) {
//                $product->addMedia($image)
//                    ->preservingOriginal()
//                    ->toMediaCollection();
//            }
//        }
}
