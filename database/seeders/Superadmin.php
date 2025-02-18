<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Superadmin extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Aldivo Ishen',
            'email' => 'almetagt@gmail.com',
            'password' => Hash::make('almetagt'),
            'company_name' => 'PT. ALMETA GLOBAL TRILINDO',
            'company_phone_number' => '081216996352',
            'company_location' => 'Surabaya',
            'company_address' => 'Jl. Petemon 1 No. 56D, Surabaya, Jawa Timur',
            'is_admin' => true,
            'status' => 'Approved', 
            'ktp' => '00000000', 
            'npwp' => '0000000',
            'nib' => '00000000',
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
