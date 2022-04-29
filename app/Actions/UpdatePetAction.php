<?php

namespace App\Actions;

use App\Models\Pet;

class UpdatePetAction
{
    public function exec(Pet $pet, array $validated = []): Pet
    {
        $pet->fill($validated)->save();

        return $pet;
    }
}
