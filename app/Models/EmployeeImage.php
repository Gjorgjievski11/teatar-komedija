<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeImage extends Model
{
    protected $fillable = ['employee_id', 'path', 'image_kit_id'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
