<?php

namespace App\Actions;

use App\Models\Pet;

class DeletePetAction
{
    public function exec(Pet $pet): bool
    {
        return $pet->delete();
    }
}
