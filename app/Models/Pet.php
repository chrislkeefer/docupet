<?php

namespace App\Models;

use App\Enums\PetGender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "pet_species_id", "pet_breed_id", "pet_breed", "gender"];

    protected $cast = [
        "gender" => PetGender::class
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function breed(): BelongsTo
    {
        return $this->belongTo(PetBreed::class, 'pet_breed_id');
    }

    public function species(): BelongsTo
    {
        return $this->belongsTo(PetSpecies::class, 'pet_species_id');
    }
}
