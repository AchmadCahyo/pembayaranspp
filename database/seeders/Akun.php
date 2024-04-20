<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Akun extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'bayu',
                'email' => 'bayu@gmail.com',
                'password' => bcrypt('12345'),
                'role' => 1
            ],
            [
                'name' => 'ayu',
                'email' => 'ayu@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 2
            ],
            [
                'name' => 'ali',
                'email' => 'ali@gmail.com',
                'password' => bcrypt('1234567'),
                'role' => 3
            ],
        ];

        foreach ($data as $key => $d) {
            User::create($d);
        }
    }
}
