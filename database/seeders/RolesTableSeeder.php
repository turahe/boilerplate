<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Services\Helpers\Acl;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::updateOrCreate([
            'name' => Acl::ROLE_DEVELOPER,
        ])->syncPermissions(Permission::all());

        Role::updateOrCreate([
            'name' => Acl::ROLE_SUPER_ADMIN,
        ])->syncPermissions(Permission::all());

        Role::updateOrCreate([
            'name' => Acl::ROLE_ADMIN,
        ])->syncPermissions(Permission::all());

        Role::updateOrCreate([
            'name' => Acl::ROLE_VENDOR,
        ])->syncPermissions(Permission::all());

        Role::updateOrCreate([
            'name' => Acl::ROLE_CUSTOMER,
        ])->syncPermissions(Permission::all());
    }
}
