<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email' => 'ciubucsilviag@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$zQESxFYhsdaUlHcOPLxLvuUkma9WQYhe3XJKwLY38bvRf8t3.oVl2', // parola mea
        ]);

        $user->assignRole(['admin', 'writer']);
    }
}
