<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityImage extends Model
{
    protected $fillable = ['activity_id', 'url', 'image_kit_id'];

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
