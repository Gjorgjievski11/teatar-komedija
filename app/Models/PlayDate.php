<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PlayDate extends Model
{
    public $timestamps = false;
    protected $fillable = ['play_id', 'played_at', 'google_calendar_id'];

    public function getFullDate()
    {
        return Carbon::parse($this->played_at)->format('Y-m-d (D.), H:i');
    }

    public function getDate(?string $format = 'Y-m-d')
    {  
        return Carbon::parse($this->played_at)->format($format);
    }

    public function getTime(?string $format = "H:i")
    {
        return Carbon::parse($this->played_at)->format($format);
    }
    
    public function play()
    {
        return $this->belongsTo(Play::class);
    }
}
