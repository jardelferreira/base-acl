<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin123'),
        ]);
        $admin->roles()->attach(1);

        $user = User::create([
            'name' => 'User Sistem',
            'email' => 'user@mail.com',
            'password' => Hash::make('user123'),
        ]);
        $user->roles()->attach(2);

    }
}
