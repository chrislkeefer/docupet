<?php

namespace Database\Factories;

use App\Enums\PetGender;
use App\Models\PetBreed;
use App\Models\PetSpecies;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "user_id" => $user_id = User::inRandomOrder()->first()->id,
            "pet_species_id" => $species_id = PetSpecies::inRandomOrder()->first()->id,
            "pet_breed_id" => PetBreed::where('pet_species_id', $species_id)->inRandomOrder()->first()->id,
            "pet_breed" => "",
            "name" => $this->faker->name,
            "description" => $this->faker->paragraph,
            "gender" => $this->faker->randomElement(PetGender::cases())
        ];
    }
}
