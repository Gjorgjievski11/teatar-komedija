<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayCategory extends Model
{
    public $timestamps = false;
    protected $fillable = ['play_id', 'category_id'];
}
