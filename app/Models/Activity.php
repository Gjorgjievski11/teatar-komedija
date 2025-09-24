<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Activity extends Model
{
    protected $fillable = ['title', 'short_description', 'description', 'date', 'image_kit_id', 'image', 'category_id'];

    public function images(): HasMany
    {
        return $this->hasMany(ActivityImage::class);
    }

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function getTime()
    {
        return $this->date?->format('H:i');
    }
    public function getDate()
    {
        \Carbon\Carbon::setLocale('mk');
        return $this->date?->isoFormat('D MMMM YYYY'); // e.g., "6 јуни 2025"
    }

    public function getCategoryName()
    {
        return match ($this->category_id) {
            1 => 'Проекти',
            2 => 'Гостувања',
            3 => 'Промоции',
            4 => 'Издавачка дејност',
        };
    }

    public function scopeSearchBy($query, $value)
    {
        if ($value) {
            $parts = explode(' ', $value);

            return $query->where(function ($q) use ($parts) {
                foreach ($parts as $part) {
                    $q->whereLike('title', "%{$part}%");
                }
            });
        }

        return $query;
    }

    public function scopeSearchByCategory($query, $value)
    {
        if ($value) {
            return $query->where('category_id', $value);
        }

        return $query;
    }
}
