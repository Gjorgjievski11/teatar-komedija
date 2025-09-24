<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobPosition extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'job_category'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function scopeSearch($query, $value)
    {
        if ($value) {
            $parts = explode(' ', $value);

            $query->where(function ($q) use ($parts) {
                foreach ($parts as $part) {
                    $q->orWhereLike('name', "%{$part}%");
                }
            });
        }

        return $query;
    }
}
