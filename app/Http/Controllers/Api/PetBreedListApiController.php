<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PetBreed;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PetBreedListApiController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $resources = QueryBuilder::for(PetBreed::class)
            ->allowedFilters(['name','pet_species_id'])
            ->get();

        return response()->json($resources);
    }
}
