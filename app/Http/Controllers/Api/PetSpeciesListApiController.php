<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PetSpecies;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PetSpeciesListApiController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $resources = QueryBuilder::for(PetSpecies::class)
            ->allowedFilters(['name'])
            ->get();

        return response()->json($resources);
    }
}
