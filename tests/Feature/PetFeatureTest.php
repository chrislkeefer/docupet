<?php

namespace Tests\Feature;

use App\Enums\PetGender;
use App\Models\Pet;
use App\Models\PetBreed;
use App\Models\PetSpecies;
use App\Models\User;
use Database\Seeders\PetSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PetFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(PetSeeder::class);
    }

    public function testGuestCanCreatePet()
    {
        $response = $this->post("/api/pet", [
            "name" => "My Pet Name",
            "description" => "My pet description",
            "pet_species_id" => $species_id = PetSpecies::inRandomOrder()->first()->id,
            "pet_breed_id" => PetBreed::where('pet_species_id', $species_id)->inRandomOrder()->first()->id,
            "gender" => PetGender::cases()[rand(0, 1)]->value,
        ], ['Accept' => 'application/json']);

        $response->assertSuccessful();
    }

    public function testUserCanCreatePet()
    {
        $this->login(User::inRandomOrder()->first());

        $response = $this->post("/api/pet", [
            "name" => "My Pet Name",
            "description" => "My pet description",
            "pet_species_id" => $species_id = PetSpecies::inRandomOrder()->first()->id,
            "pet_breed_id" => PetBreed::where('pet_species_id', $species_id)->inRandomOrder()->first()->id,
            "gender" => PetGender::cases()[rand(0, 1)]->value,
        ], ['Accept' => 'application/json']);

        $response->assertSuccessful();
    }

    public function testUserCanUpdatePet()
    {
        $this->login($user = User::factory()->has(Pet::factory())->create());

        $response = $this->put("/api/pet/{$user->pets->first()->id}", [
            "name" => "User Updated Pet Name",
            "description" => "My updated pet description",
            "pet_species_id" => $species_id = PetSpecies::inRandomOrder()->first()->id,
            "pet_breed_id" => PetBreed::where('pet_species_id', $species_id)->inRandomOrder()->first()->id,
            "gender" => PetGender::cases()[rand(0, 1)]->value,
        ], ['Accept' => 'application/json']);

        $response->assertSuccessful();
    }

    public function testGuestCanNotUpdatePet()
    {
        $pet = Pet::factory()->create();

        $response = $this->put("/api/pet/{$pet->id}", [
            "name" => "My Pet Name",
            "description" => "My pet description",
            "pet_species_id" => $species_id = PetSpecies::inRandomOrder()->first()->id,
            "pet_breed_id" => PetBreed::where('pet_species_id', $species_id)->inRandomOrder()->first()->id,
            "gender" => PetGender::cases()[rand(0, 1)]->value,
        ], ['Accept' => 'application/json']);

        $response->assertForbidden();
    }

    public function testUserCanNotUpdateAPetTheyDoNotOwn()
    {
        $pet = Pet::factory()->create();

        $response = $this->put("/api/pet/{$pet->id}", [
            "name" => "User Updated Pet Name",
            "description" => "My updated pet description",
            "pet_species_id" => $species_id = PetSpecies::inRandomOrder()->first()->id,
            "pet_breed_id" => PetBreed::where('pet_species_id', $species_id)->inRandomOrder()->first()->id,
            "gender" => PetGender::cases()[rand(0, 1)]->value,
        ], ['Accept' => 'application/json']);

        $response->assertForbidden();
    }

    public function testUserCanDeletePetRecord()
    {
        $this->login($user = User::factory()->has(Pet::factory())->create());

        $response = $this->delete("/api/pet/{$user->pets->first()->id}", [], ['Accept' => 'application/json']);

        $response->assertSuccessful();
    }

    public function testGuestCanNotDeletePetRecord()
    {
        $pet = Pet::factory()->create();

        $response = $this->delete("/api/pet/{$pet->id}", [], ['Accept' => 'application/json']);

        $response->assertForbidden();
    }
}
