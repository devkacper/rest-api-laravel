<?php

namespace App\Models;

use App\Events\CreatingPet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = ['category_id', 'name', 'photoUrls', 'status'];

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
        return $this->hasMany(PetTags::class);
    }
}
