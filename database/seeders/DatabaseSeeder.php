<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Victor',
            'email' => 'victor@airbnbkenya.com',
            'phone' => '+254 712 878432',
            'type' => User::TYPE['admin'],
            'password' => bcrypt('password')
        ]);
    }
}