<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

         \App\Models\User::factory()->create([
             'name' => 'Reymond Admin',
             'email' => 'test@gmail.com',
             'username' => 'admin',
             'is_admin' => true,
             'email_verified_at' => now(),
             'password' => Hash::make('password'),
         ]);
    }
}
