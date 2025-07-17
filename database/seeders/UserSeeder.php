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
                'username' => 'operator',
                'name' => 'Operator',
                'password' => bcrypt('123'),
                'roles' => 'operator',
            ],
            [
                'username' => 'admin',
                'name' => 'Admin',
                'password' => bcrypt('123'),
                'roles' => 'admin',
            ],
            [
                'username' => 'pimpinan',
                'name' => 'Pimpinan',
                'password' => bcrypt('123'),
                'roles' => 'pimpinan',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}