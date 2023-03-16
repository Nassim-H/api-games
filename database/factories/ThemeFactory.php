<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ThemeFactory extends Factory
{
    const THEME = ['THEME1','THEME2','THEME3','THEME4','THEME5','THEME6'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=>$this->faker->randomElement(self::THEME),
        ];
    }
}
