<?php

namespace Feature\Api;

use App\Enum\PetStatusEnum;
use App\Models\Category;
use App\Models\Pet;
use Tests\TestCase;

class PetTest extends TestCase
{
    /**
     * Test of selecting specific Pet.
     *
     * @return void
     */
    public function testSelectingPet(): void
    {
        $pet = Pet::inRandomOrder()->limit(1)->first();

        $response = $this->get(route('pet.show', $pet));

        $this->assertEquals($response->original['id'], $pet->id);

        $response->assertStatus(200);
    }

    /**
     * Test of adding a new Pet to the database store.
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

        $response = $this->post(route('pet.store'), $attributes);

        $this->assertDatabaseHas('pets', [
            'status' => $attributes['status'],
            'name' => $attributes['name'],
            'photoUrls' => $attributes['photoUrls'],
            'category_id' => Category::where('name', $attributes['category'])->pluck('id')->first(),
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test of update an existing Pet.
     *
     * @return void
     */
    public function testUpdatePet()
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

        $response = $this->put(route('pet.update', $pet), $attributes);

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

        $response->assertStatus(200);
    }

    /**
     * Test of delete a Pet.
     *
     * @return void
     */
    public function testDeletePet()
    {
        $pet = Pet::inRandomOrder()->limit(1)->first();

        $response = $this->delete(route('pet.destroy', $pet));

        $this->assertDatabaseMissing('pets', $pet->getAttributes());

        $response->assertStatus(200);
    }

    /**
     * Test of finding Pet by status.
     *
     * @return void
     */
    public function testFindPetsByStatus()
    {
        $status = PetStatusEnum::cases()[array_rand(PetStatusEnum::cases())]->value;

        $pet = Pet::where('status', $status)->limit(1)->first();

        $response = $this->get(route('findByStatus', [
            'status' => $status
        ]));

        $response->assertSee($pet->name);
        $response->assertStatus(200);
    }
}
