<?php

namespace App\Events\Pet;

use App\Models\Pet;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdatingPet
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(Pet $pet)
    {
        $this->pet = $pet;
    }

}
