<?php

namespace App\Actions;

use App\Models\Pet;

class UpdatePetAction
{
    public function exec(array $validated = [], Pet $pet): Pet
    {
        $pet->fill($validated)->save();

        return $pet;
    }
}