<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Moderator']);
        Role::create(['name' => 'Writer']);
        Role::create(['name' => 'Reader']);

        $user=User::create([
            'name' => 'admin',
            'email' => 'admin@mobillium.com',
            'password' => bcrypt('mobillium')
        ]);
        $user->syncRoles('Admin');

        $user=User::create([
            'name' => 'writer1',
            'email' => 'writer1@mobillium.com',
            'password' => bcrypt('mobillium')
        ]);
        $user->syncRoles('Writer');
    }
}
