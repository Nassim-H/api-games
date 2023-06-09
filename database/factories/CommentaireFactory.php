<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>$this->faker->numberBetween(1,10),
            'jeu_id'=>$this->faker->numberBetween(1,10),
            'note'=>$this->faker->numberBetween(0,20),
            'commentaire'=>substr($this->faker->words(20, true), 0, 50),
        ];
    }
}
