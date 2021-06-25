<?php

namespace Database\Factories;

use App\Models\Social;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class SocialFactory.
 */
class SocialFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Social::class;

    /**
     * @return array
     */
    public function definition()
    {
        $socials = ['facebook', 'twitter', 'youtube', 'linkedin', 'behance', 'pinterest'];
        $name = $this->faker->userName;

        return [
            'name' => $name,
            'url' => 'https://'.$this->faker->randomElement($socials).'.com/'.Str::slug($name),
            'text' => 'FOLLOW US',
        ];
    }
}
