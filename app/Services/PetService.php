<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Pet;

class PetService
{
    public function getPets()
    {
        $pets = Pet::with('tags')->get();

        return $pets;
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

    /**
     * Return pet categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPetCategories()
    {
        $categories = Category::all();

        return $categories;
    }

    /**
     * Get Pets by status.
     *
     * @return void
     */
    public function getByStatus($status)
    {
        $pets = Pet::with('category', 'tags')->where('status', $status)->get();

        return $pets;
    }

    /**
     * Upload Pet image in app storage.
     *
     * @param $image
     * @param $pet
     * @return void
     */
    public function uploadPetImage($image, $pet)
    {
        $imageName = time().'.'.$image->extension();

        $image->storeAs('public/pets', $imageName);

        $pet->update([
            'photoUrls' => $imageName
        ]);
    }
}
