<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class AdminUsersTableSeeder.
 */
class UsersTableSeeder extends Seeder
{
    /**
     * Seed default users.
     *
     * @return array
     */
    protected array $defaultUser = [

        [
            'name' => 'Nur Wachid',
            'phone' => '08522534934',
            'email' => 'wachid@outlook.com',
            'role' => 'developer',
            'token' => '12341',

        ],
        [
            'name' => 'Author',
            'phone' => '0824234238943',
            'email' => 'sparrow.dewa@gmail.com',
            'role' => 'vendor',
            'token' => '12342',
        ],
        [
            'name' => 'Admin',
            'phone' => '089523324234',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'token' => '12343',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
        User::truncate();
        Vendor::truncate();
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
        ]);

        $users = $this->defaultUser;

        foreach ($users as $index => $user) {
            $user = User::updateOrCreate(['email' => $user['email']],
                [
                'name' => $user['name'],
                'email' => $user['email'],
                'email_verified_at' => now()->toDateTimeString(),
                'password' => bcrypt('secret'),
                'api_token' => Str::random(),
                'remember_token' => Str::random(10),
            ])->assignRole($user['role']);
            $user->addMediaFromUrl('https://picsum.photos/id/'.$index.'/1024/1024')
                ->toMediaCollection('image');
            $user->profile()->save(Profile::factory()->make());
            if ($user->hasRole('vendor')) {
                $user->vendor()->save(Vendor::factory()->state(['type' => 'vendor', 'email' => $user->email, 'name' => $user->name])->make());
            }
        }

        User::factory(25)->create()->each(function (User $user) {
            $user->assignRole(Arr::random(['vendor', 'customer'], 1));
            if ($user->hasRole('vendor')) {
                $user->vendor()->save(Vendor::factory()->state(['type' => 'vendor', 'email' => $user->email, 'name' => $user->name])->make());
            }
        });
    }
}
