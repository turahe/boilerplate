<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the user should have a personal team.
     *
     * @return $this
     */
    public function withPersonalTeam()
    {
        return $this->has(
            Team::factory()
                ->state(function (array $attributes, User $user) {
                    return ['name' => $user->name.'\'s Team', 'user_id' => $user->id, 'personal_team' => true];
                }),
            'ownedTeams'
        );
    }

    public function withRelation()
    {
        return $this->has(
            Profile::factory()->create()
        );
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->generateToken(32);
            $user->assignRole('customer');
        })->afterMaking(function (User $user) {
//            dd($user);
//            $user->addMedia(storage_path('app/seeder/users/user-'.$user->id.'.png'))
//                ->usingName($user->name)
//                ->preservingOriginal()
//                ->toMediaCollection('avatar');
        });

//            $user->profile()->save(Profile::factory()->make());
//            $user->addresses()->saveMany(Address::factory(mt_rand(1, 3))->make());
    }
}
