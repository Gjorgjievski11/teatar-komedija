<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function scopeSearch($query, $value)
    {
        if ($value) {
            $parts = explode(' ', $value);

            $query->where(function ($q) use ($parts) {
                foreach ($parts as $part) {
                    return $q->whereLike('name', "%{$part}%");
                }
            });
        }
    }
}
