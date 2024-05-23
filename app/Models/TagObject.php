<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagObject extends Model
{
    protected $table = 'tag_object';
    public $timestamps = false;

    protected $fillable = ['tag_id', 'pet_id'];
}
