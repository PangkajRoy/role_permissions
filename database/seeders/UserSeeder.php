<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = Admin::where('email', 'pangkajroy@gmail.com')->first();
        if (is_null($user)) {
            $user = new Admin();
            $user->name = 'Pangkaj Roy';
            $user->email = 'pangkajroy@gmail.com';
            $user->password = Hash::make('12345678');
            $user->save();
        }
    }
}
