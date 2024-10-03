<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'test@gmail.com',
            'encrypted_password' => bcrypt('password1'),
        ]);

        User::create([
            'email' => 'test2@gmail.com',
            'encrypted_password' => bcrypt('password2'),
        ]);
    }
}
