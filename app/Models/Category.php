<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public const NAKED_MOON = 3;
    public $timestamps = false;
    protected $fillable = ['name'];

    public function scopeSearch($query, $value)
    {
        if ($value) {
            $parts = explode(' ', $value);

            $query->where(function ($q) use ($parts) {
                foreach ($parts as $part) {
                    $q->whereLike('name', "%{$part}%");
                }
            });
        }

        return $query;
    }
}
