<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(PermissionSeeder::class);

        \App\Models\Slider::factory(20)->create();
        \App\Models\PortfolioCategory::factory(10)->create();
        \App\Models\Portfolio::factory(30)->create();
        \App\Models\ArticleCategory::factory(10)->create();
        \App\Models\Article::factory(30)->create();
    }
}
