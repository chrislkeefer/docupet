<?php

namespace App\Http\Requests;

use App\Models\Pet;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($pet = $this->route('pet'))
            return $this->user()->can('update', $pet);
        
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "gender" => "sometimes|required|string|in:male,female",
            "pet_species_id" => "sometimes|nullable|exists:pet_species,id",
            "pet_breed" => "sometimes|nullable|string",
            "pet_breed_id" => "sometimes|required|exists:pet_breeds,id",
            "name" => "sometimes|required|string",
            "description" => "nullable|string"
        ];
    }
}
