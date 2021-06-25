<?php

namespace Database\Factories;

use App\Models\ContactUs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ContactUsFactory.
 */
class ContactUsFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = ContactUs::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'subject' => $this->faker->sentence,
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->paragraph(3, true),
        ];
    }
}
