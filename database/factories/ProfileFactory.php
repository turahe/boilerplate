<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class ProfileFactory.
 */
class ProfileFactory extends Factory
{
    /**
     * @var string
     */
    protected $model = Profile::class;

    /**
     * @return array
     */
    public function definition()
    {
        $this->faker->addProvider(new \Faker\Provider\id_ID\Person($this->faker));

        $user_User_Name = $this->faker->firstName($gender = 'male');
        $name = $this->faker->firstName;
        $blood = $this->faker->randomElement(['A+', 'O+', 'B+', 'AB+', 'A-', 'O-', 'B-', 'AB-']);
        $marital = $this->faker->randomElement(['divorced', 'single', 'married', 'undefined']);
        $hobbies = $this->faker->randomElement(['3D printing', 'Acrobatics', 'Acting', 'Amateur radio', 'Animation', 'Aquascaping', 'Astrology', 'Astronomy', 'Baking', 'Baton twirling', ' Blogging', 'Building', 'Board/tabletop games', 'Book discussion clubs', 'Book restoration', 'Bowling', 'Brazilian jiu-jitsu', 'Breadmaking', 'Bullet journaling', 'Cabaret', 'Calligraphy', 'Candle making', 'Candy making', 'Car fixing & building', 'Card games', 'Cheesemaking', 'Cleaning', 'Clothesmaking', 'Coffee roasting', 'Collecting', 'Coloring']);

        return [
            'first_name' => $name,
            'last_name' => $user_User_Name,
            'alias' => $name,
            'marital' => $marital,
            'citizenship' => $this->faker->nik,
            'number_personnel' => $this->faker->nik,
            'number_citizen' => $this->faker->nik,
            'number_taxpayer' => $this->faker->uuid,
            'number_passport' => $this->faker->uuid,
            'hobby' => $hobbies,
            'weight' => mt_rand(50, 120),
            'height' => mt_rand(150, 200),
            'size_shoes' => mt_rand(38, 44),
            'size_shirt' => mt_rand(38, 44),
            'size_pants' => mt_rand(38, 44),
            'blood' => $blood,
            'eyes' => '-1',
            'rhesus' => '+',
            'gender' => $this->faker->boolean,
            'birthplace' => $this->faker->city,
            'birthday' => $this->faker->dateTimeBetween('-30 years', '-20 years'),
            'biography' => $this->faker->sentences(3, true),
        ];
    }
}
