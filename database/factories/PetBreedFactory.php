<?php

namespace Database\Factories;

use App\Models\PetSpecies;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PetBreed>
 */
class PetBreedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "pet_species_id" => PetSpecies::inRandomOrder()->first()->id,
            "name" => $this->faker->word,
            "description" => $this->faker->paragraph
        ];
    }
}
