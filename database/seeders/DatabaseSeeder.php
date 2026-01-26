<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::UpdateOrCreate(['email' => 'flight@admin.com'], [
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin@123'),
            'role' => User::$admin,
            'password_2' => 'Admin@123',
            'mobile' => 7742421918
        ]);
    }
}
