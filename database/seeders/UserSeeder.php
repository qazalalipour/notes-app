<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ['first_name' => 'کاربر', 'last_name' => 'شماره ۱', 'mobile' => '09120000001'],
            ['first_name' => 'کاربر', 'last_name' => 'شماره ۲', 'mobile' => '09120000002'],
            ['first_name' => 'کاربر', 'last_name' => 'شماره ۳', 'mobile' => '09120000003'],
        ]);
    }
}
