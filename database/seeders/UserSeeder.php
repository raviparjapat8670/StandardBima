<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Create 10 fake users using the factory
         User::factory()->count(10)->create();  // Creates 10 users

         // Or if you want to create a specific number of users with more control
         // User::factory()->count(10)->create();
    }
}
