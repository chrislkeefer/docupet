<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetSpecies extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description"];

    public function breeds(): HasMany
    {
        return $this->hasMany(PetBreed::class, 'pet_species_id', 'id');
    }
}
