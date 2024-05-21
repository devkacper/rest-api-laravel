<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Pet;

class PetService
{
    /**
     * Find pet by ID.
     *
     * @param $pet
     * @return mixed
     */
    public function getPet($pet)
    {
        return $pet;
    }

    /**
     * Add a new pet to the store.
     *
     * @param $data
     * @return mixed
     */
    public function storePet($data)
    {
        $pet = Pet::create([
            'category_id' => Category::where('name', $data['category'])->pluck('id')->first(),
            'name' => $data['name'],
            'photoUrls' => $data['photoUrls'],
            'status' => $data['status'],
        ]);

        return $pet;
    }

    /**
     * Update an existing pet.
     *
     * @param $data
     * @return mixed
     */
    public function updatePet($data)
    {
        return $data['pet']->update([
            'category_id' => Category::where('name', $data['request']['category'])->pluck('id')->first(),
            'name' => $data['request']['name'],
            'photoUrls' => $data['request']['photoUrls'],
            'status' => $data['request']['status'],
        ]);
    }

    /**
     * Deletes a pet.
     *
     * @param $pet
     * @return mixed
     */
    public function deletePet($pet)
    {
        return $pet->delete();
    }
}
