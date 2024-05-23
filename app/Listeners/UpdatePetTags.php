<?php

namespace App\Listeners;

use App\Events\Pet\UpdatingPet;
use App\Services\TagService;
use Illuminate\Support\Facades\Request;

class UpdatePetTags
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
    public function handle(UpdatingPet $event): void
    {
        $this->tagService->storeTags($event);
    }
}
