<?php

namespace Database\Seeders;

use App\Models\users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::create([
            'name' => 'admin',
            'email' => 'rekap_admin@gmail.com',
            'password' => Hash::make('adminrekap'),
            'role' => 'admin',
        ]);
    }
}
