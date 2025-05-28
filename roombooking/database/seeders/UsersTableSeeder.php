<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@site.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@site.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'role' => 'admin'
            ]
        );
        //
    }
}
