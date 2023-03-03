<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class EditeurFactory extends Factory
{
    const EDITEURS = ['EDITEUR1','EDITEUR2','EDITEUR3','EDITEUR4','EDITEUR5','EDITEUR6'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=>$this->faker->randomElement(self::EDITEURS),
        ];
    }
}
