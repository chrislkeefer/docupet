<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PetBreed extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description"];

    public function species(): BelongsTo
    {
        return $this->belongsTo(PetSpecies::class, 'pet_species_id', 'id');
    }

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class, 'pet_breed_id', 'id');
    }
}
