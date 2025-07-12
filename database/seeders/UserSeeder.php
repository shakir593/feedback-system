<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $users = [

            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin_123')
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('john_123')
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('jane_123')
            ],
            [
                'name' => 'Selena Gomez',
                'email' => 'selena.gomez@example.com',
                'password' => Hash::make('selena_123')
            ],
            [
                'name' => 'Taylor Swifth',
                'email' => 'taylor.swifth@example.com',
                'password' => Hash::make('selena_123')
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
