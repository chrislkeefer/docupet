<?php

namespace App\Http\Controllers\Api;

use App\Actions\CreatePetAction;
use App\Actions\DeletePetAction;
use App\Actions\UpdatePetAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;
use App\Http\Resources\PetCollection;
use App\Http\Resources\PetResource;
use App\Models\Pet;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PetResourceApiController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Pet::class, 'pet');
    }

    public function index(): JsonResponse
    {
        return response()->json(
            new PetCollection(Pet::paginate())
        );
    }

    public function store(StorePetRequest $request, CreatePetAction $action): JsonResponse
    {
        $pet = $action->exec([
            ...$request->validated(),
            "user_id" => $request->user()?->id
        ]);

        return response()->json(new PetResource($pet));
    }

    public function show(Pet $pet): JsonResponse
    {
        return response()->json(new PetResource($pet));
    }

    public function update(UpdatePetRequest $request, Pet $pet, UpdatePetAction $action): JsonResponse
    {
        $pet = $action->exec($pet, $request->validated());

        return response()->json(new PetResource($pet));
    }


    public function destroy(Pet $pet, DeletePetAction $action): JsonResponse
    {
        abort_unless($action->exec($pet), Response::HTTP_INTERNAL_SERVER_ERROR);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
