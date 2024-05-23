<?php

namespace App\Services;

use App\Models\Tag;
use App\Models\TagObject;
use Illuminate\Support\Facades\Request;

class TagService
{
    /**
     * Store tags in database.
     *
     * @param $event
     * @return void
     */
    public function storeTags($event)
    {
        TagObject::where('pet_id', $event->pet->id)->delete();

        $tags = explode(',', Request::input('tags'));

        foreach($tags as $tag)
        {
            $tag = Tag::updateOrCreate([
                'name' => $tag
            ]);

            TagObject::create([
                'pet_id' => $event->pet->id,
                'tag_id' => $tag['id']
            ]);
        }
    }
}
