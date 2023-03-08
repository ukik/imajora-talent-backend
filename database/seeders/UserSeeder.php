<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Unique;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'slug' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'api_token' => Str::random(32),
            'role' => 'admin',
        ]);

        User::factory()
            ->count(100)
            ->create();
    }
}