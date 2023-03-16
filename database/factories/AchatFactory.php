<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AchatFactory extends Factory
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
            'lieu_achat'=>$this->faker->city(),
            'prix'=>$this->faker->numberBetween(1,1000),
        ];
    }
}
