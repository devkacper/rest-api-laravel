<?php

namespace App\Models;

use App\Events\Pet\CreatedPet;
use App\Events\Pet\UpdatingPet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['category_id', 'name', 'photoUrls', 'status'];

    protected $dispatchesEvents = [
        'created' => CreatedPet::class,
        'updating' => UpdatingPet::class,
    ];

    /**
     * Pet category relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_object', 'pet_id', 'tag_id');
    }
}
