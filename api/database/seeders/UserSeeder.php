<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Leandro Viana',
            'email' => 'leandroviana28@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('123456789'),
            'remember_token' => Str::random(10),
        ]);

        User::factory()
            ->count(10)
            ->create();
    }
}
