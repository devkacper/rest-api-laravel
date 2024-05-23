<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetRequest;
use App\Models\Pet;
use App\Services\PetService;

class PetController extends Controller
{
    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = $this->petService->getPets()->sortByDesc('id');

        return view('pet.index', compact('pets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->petService->getPetCategories();

        return view('pet.edit', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PetRequest $request)
    {
        $pet = $this->petService->storePet($request->safe()->all());

        return redirect()->back()->with('success', 'Pomyślnie utworzono nowy rekord.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pet $pet)
    {
        $categories = $this->petService->getPetCategories();

        return view('pet.edit', compact('pet', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PetRequest $request, Pet $pet)
    {
        $this->petService->updatePet([
            'pet' => $pet,
            'request' => $request->safe()->all()
        ]);

        return redirect()->back()->with('success', 'Pomyślnie zapisano zmiany.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        $this->petService->deletePet($pet);

        return back()->with('success', 'Usunięto wybraną pozycję.');
    }
}
