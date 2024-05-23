<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetRequest;
use App\Http\Requests\StatusRequest;
use App\Models\Pet;
use App\Services\PetService;

class PetController extends Controller
{
    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PetRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function store(PetRequest $request)
    {
        $pet = $this->petService->storePet($request->safe()->all());

        return response($pet, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param Pet $pet
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function show(Pet $pet)
    {
        return response($pet, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Pet $pet
     * @param PetRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function update(Pet $pet, PetRequest $request)
    {
        $pet = $this->petService->updatePet([
            'pet' => $pet,
            'request' => $request->safe()->all()
        ]);

        return response($pet, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Pet $pet
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Foundation\Application|\Illuminate\Http\Response
     */
    public function destroy(Pet $pet)
    {
        $this->petService->deletePet($pet);

        return response([
            'message' => 'Selected pet was deleted.'
        ], 200);
    }

    /**
     * Return Pet resource with specific status.
     *
     * @param StatusRequest $request
     * @return string
     */
    public function findByStatus(StatusRequest $request)
    {
        $pets = $this->petService->getByStatus($request->safe()->status);

        return $pets;
    }
}
