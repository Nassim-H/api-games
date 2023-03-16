<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\CategoriesFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(EditeursSeeder::class);
        $this->call(ThemeSeeder::class);
        $this->call(JeuSeeder::class);
        $this->call(AchatSeeder::class);
        $this->call(CommentaireSeeder::class);
        $this->call(LikeSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RoleUserSeeder::class);
    }
}
