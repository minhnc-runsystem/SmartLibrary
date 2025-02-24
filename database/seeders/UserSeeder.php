<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456789'),
            'role' => 'admin',
        ]);

        User::factory(10)->create(); // Tạo thêm 10 user ngẫu nhiên
    }
}

