<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin ',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'picture' => '',
            'phone_number' => ''
        ]);
    }
}
