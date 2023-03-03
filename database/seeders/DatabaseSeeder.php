<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\CategorieFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategorieSeeder::class);
        $this->call(EditeurSeeder::class);
        $this->call(ThemeSeeder::class);
        $this->call(JeuSeeder::class);
        $this->call(AchatSeeder::class);
        $this->call(CommentaireSeeder::class);
        $this->call(LikeSeeder::class);
    }
}
