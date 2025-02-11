<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(RolePermissionSeeder::class);

        $user = Admin::where('email', 'pangkajroy@gmail.com')->first();
        if (!is_null($user)) {
            $user->assignRole('Super Admin');
        }
    }
}
