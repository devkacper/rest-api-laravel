<?php

namespace Database\Factories;

use App\Enum\PetStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = PetStatusEnum::cases();
        return [
            'category_id' => rand(1,3),
            'name' => fake()->userName,
            'photoUrls' => fake()->imageUrl,
            'status' => $status[array_rand($status)]->value,
        ];
    }
}
