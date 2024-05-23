<?php

namespace Tests\Feature;

use App\Enum\PetStatusEnum;
use App\Models\Category;
use App\Models\Pet;
use Tests\TestCase;

class PetTest extends TestCase
{
    /**
     * Test of view with Pet resources.
     *
     * @return void
     */
    public function testPetsResourcesView(): void
    {
        $pet = Pet::inRandomOrder()->limit(1)->first();

        $response = $this->get('/');

        $response->assertSee($pet->name);
        $response->assertSee('Nazwa');
        $response->assertStatus(200);
    }

    /**
     * Test of the form view for creating a new Pet resource.
     *
     * @return void
     */
    public function testCreatePetView()
    {
        $response = $this->get(route('pets.create'));

        $response->assertSee('name');
        $response->assertStatus(200);

    }

    /**
     * Test of adding a new Pet to the database store from form on create page view.
     *
     * @return void
     */
    public function testStorePet()
    {
        $attributes = [
            'status' => PetStatusEnum::cases()[array_rand(PetStatusEnum::cases())]->value,
            'name' => fake()->name,
            'photoUrls' => fake()->imageUrl,
            'category' => Category::inRandomOrder()->pluck('name')->first(),
        ];

        $response = $this->post(route('pets.store'), $attributes);

        $this->assertDatabaseHas('pets', [
            'status' => $attributes['status'],
            'name' => $attributes['name'],
            'photoUrls' => $attributes['photoUrls'],
            'category_id' => Category::where('name', $attributes['category'])->pluck('id')->first(),
        ]);

        $response->assertSessionHas('success', 'Pomyślnie utworzono nowy rekord.');
        $response->assertStatus(302);
    }

    /**
     * Test of edit view with specified Pet resource.
     *
     * @return void
     */
    public function testEditPetView(): void
    {
        $pet = Pet::inRandomOrder()->limit(1)->first();

        $response = $this->get(route('pets.edit', $pet));

        $response->assertSee($pet->name);
        $response->assertSee('ZAPISZ');
        $response->assertStatus(200);
    }

    /**
     * Test of successfully update an existing Pet from form on edit page view.
     *
     * @return void
     */
    public function testUpdatePet(): void
    {
        $pet = Pet::inRandomOrder()->limit(1)->first();
        $status = PetStatusEnum::cases()[array_rand(PetStatusEnum::cases())]->value;

        $attributes = [
            'id' => $pet->id,
            'category' => Category::inRandomOrder()->pluck('name')->first(),
            'name' => fake()->userName,
            'photoUrls' => fake()->imageUrl,
            'status' => $status,
        ];

        $response = $this->put(route('pets.update', $pet), $attributes);

        $this->assertDatabaseHas('pets', [
            'id' => $attributes['id'],
            'category_id' => Category::where('name', $attributes['category'])->pluck('id')->first(),
            'name' => $attributes['name'],
            'photoUrls' => $attributes['photoUrls'],
            'status' => $attributes['status'],
        ]);

        $this->assertDatabaseMissing('pets', [
            'id' => $pet['id'],
            'category_id' => $pet['category_id'],
            'name' => $pet['name'],
            'photoUrls' => $pet['photoUrls'],
            'status' => $pet['status'],
        ]);

        $response->assertSessionHas('success', 'Pomyślnie zapisano zmiany.');
        $response->assertStatus(302);
    }

    /**
     * Test of delete a Pet by web form request.
     *
     * @return void
     */
    public function testDeletePet(): void
    {
        $pet = Pet::inRandomOrder()->limit(1)->first();

        $response = $this->delete(route('pets.destroy', $pet));

        $this->assertDatabaseMissing('pets', $pet->getAttributes());

        $response->assertSessionHas('success', 'Usunięto wybraną pozycję.');
        $response->assertStatus(302);
    }
}
