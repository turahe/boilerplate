<?php

namespace Database\Factories;

use App\Models\NewsletterSubscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class NewsletterSubscriptionFactory.
 */
class NewsletterSubscriptionFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = NewsletterSubscription::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->email,
        ];
    }
}
