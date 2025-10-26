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

    public function playEmployees()
    {
        return $this->belongsToMany(
            \App\Models\PlayEmployee::class,
            'contribution_play_employee',   // pivot table
            'contribution_id',              // this model's pivot FK
            'play_employee_id'              // related model's pivot FK
        )->withTimestamps();
    }
}
