<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'user_id' => '10000000',
            'name' => 'Aldivo Ishen',
            'email' => 'aldivo.ishen@gmail.com',
            'password' => Hash::make('aldivo99'),
            'company_name' => 'PT. ALMETA GLOBAL TRILINDO',
            'company_phone_number' => '081216996352',
            'company_location' => 'Surabaya',
            'company_address' => 'Jl. Petemon 1 No. 56D, Surabaya, Jawa Timur',
            'is_admin' => true,
            'status' => 'Approved',
            'ktp' => '00000000',
            'npwp' => '00000000',
            'nib' => '00000000',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
