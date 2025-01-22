<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Aldivo Ishen',
            'email' => 'aldivo.ishen@gmail.com',
            'password' => 'admin1',
            // 'phone_number' => '087810280556'
        ]);
    }
}
