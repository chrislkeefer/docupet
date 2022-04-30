<?php

namespace App\Http\Requests;

use App\Models\Pet;
use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "gender" => "required|string|in:male,female",
            "pet_species_id" => "required|nullable|exists:pet_species,id",
            "pet_breed_id" => "nullable|exists:pet_breeds,id",
            "pet_breed" => "nullable|string",
            "name" => "required|string",
            "description" => "nullable|string"
        ];
    }
}
