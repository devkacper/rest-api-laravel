<?php

namespace App\Listeners;

use App\Events\Pet\CreatedPet;
use App\Services\TagService;

class SetPetTags
{
    /**
     * Create the event listener.
     */
    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    /**
     * Handle the event.
     */
    public function handle(CreatedPet $event): void
    {
        $this->tagService->storeTags($event);
    }
}
