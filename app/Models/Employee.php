<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    public const IS_DIRECTOR = 1;
    public const IS_ACTER = 1;

    protected $fillable = ['name', 'surname', 'description', 'job_position_id'];


    public function images(): HasMany
    {
        return $this->hasMany(EmployeeImage::class);
    }

    public function jobPosition(): BelongsTo
    {
        return $this->belongsTo(JobPosition::class);
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

    public function scopeSearchPosition($query, $value)
    {
        if ($value) {
            return $query->where('job_position_id', $value);
        }

        return $query;
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }
}
