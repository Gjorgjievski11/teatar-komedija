<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Contribution;

class PlayEmployee extends Model
{
    protected $fillable = ['play_id', 'employee_id', 'contribution_id', 'role_name'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function contributions()
    {
        return $this->belongsToMany(
            Contribution::class,
            'contribution_play_employee',
            'play_employee_id',
            'contribution_id'
        )->withTimestamps();
    }
}
