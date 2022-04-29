<?php

namespace App\Actions;

use App\Models\Pet;
use App\Models\User;

class CreatePetAction
{
    public function exec(array $validated = [], ?User $user): ?Pet
    {
        if ($user)
            $validated['user_id'] = $user->id;

        $pet = Pet::create([
            ... $validated
        ]);

        return $pet;
    }
}