<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'admin',
                'name' => 'Admin',
                'password' => bcrypt('123'),
                'roles' => 'Admin',
            ],
            [
                'username' => 'kasir',
                'name' => 'Kasir',
                'password' => bcrypt('123'),
                'roles' => 'Kasir',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}