<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayEmployee extends Model
{
    protected $fillable = ['play_id', 'employee_id', 'contribution_id', 'role_name'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
