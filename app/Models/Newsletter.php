<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $fillable = ['email'];

    public function scopeSearch($query, $value)
    {
        if ($value) {
            return $query->whereLike('email', "%{$value}%");
        }

        return $query;
    }
}
