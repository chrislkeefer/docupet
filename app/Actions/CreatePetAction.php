<?php

namespace App\Actions;

use App\Models\Pet;
use App\Models\User;

class CreatePetAction
{
    public function exec($validated = []): ?Pet
    {
        $pet = Pet::create([
            ...$validated
        ]);

        return $pet;
    }
}
