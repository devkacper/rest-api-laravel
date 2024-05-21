<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['skrzydlate', 'domowe', 'futerkowe'];

        foreach ($tags as $tag) {
            Tag::factory()->create([
                'name' => $tag
            ]);
        }
    }
}
