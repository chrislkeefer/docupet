<?php

namespace Database\Seeders;

use App\Models\Pet;
use App\Models\PetBreed;
use App\Models\PetSpecies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PetSpecies::factory(3)->has(PetBreed::factory(10), 'breeds')->create();
        
        \App\Models\User::factory(10)->has(Pet::factory(2), 'pets')->create();
    }
}
