<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class JeuFactory extends Factory
{
    const GAMES =['GAME1','GAME2','GAME3','GAME4','GAME5','GAME6'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->randomElement(self::GAMES),
            'description' =>substr($this->faker->words(20, true), 0, 50),
            'langue' => $this->faker->country(),
            'url_media' => substr($this->faker->words(1, true), 0, 50),
            'age_min'=> $this->faker->numberBetween(3,18),
            'nombre_joueurs_min'=>$this->faker->numberBetween(1,5),
            'nombre_joueurs_max'=>$this->faker->numberBetween(2,20),
            'categorie_id'=>$this->faker->numberBetween(1,10),
            'theme_id'=>$this->faker->numberBetween(1,10),
            'editeur_id'=>$this->faker->numberBetween(1,10),
        ];
    }
}
