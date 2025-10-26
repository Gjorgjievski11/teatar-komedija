<?php

namespace App\Models;


use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Number;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Play extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'duration', 'short_description', 'description', 'poster', 'image_kit_id', 'ticket_url', 'price'];

    public function getCarbonDuration()
    {
        return CarbonInterval::minutes($this->duration)->cascade();
    }

    public function getDuration()
    {
        $interval = $this->getCarbonDuration();
        $hours = $interval->hours;
        $mins = $interval->minutes;

        if (!$mins)
            return "{$hours} часа";

        return "{$hours} часа {$mins} минути";
    }

    public function getFormattedDateRange()
    {
        $dates = $this->dates->sortBy('played_at');

        if ($dates->isEmpty()) {
            return null;
        }

        $start = Carbon::parse($dates->first()->played_at);
        $end = Carbon::parse($dates->last()->played_at);

        // Format day range
        $dayRange = $start->format('d') . '-' . $end->format('d');

        // Set locale to Macedonian
        Carbon::setLocale('mk');

        // Get month name in Macedonian (Carbon uses translatedFormat for locales)
        $month = $start->translatedFormat('F'); // returns "јуни" in Macedonian

        // Format year
        $year = $start->format('Y');

        return "{$dayRange} {$month} {$year}";
    }

    public function getPrice()
    {
        return Number::currency($this->price, 'MKD', app()->getLocale(), 0);
    }

    public function getPremiere()
    {
        $firstDateModel = $this->dates->sortBy('played_at')->first();

        if (!$firstDateModel) {
            return null;
        }

        $firstDate = Carbon::parse($firstDateModel->played_at);

        return $firstDate->isFuture() ? $firstDate->format('l F d, H:i') : null;
    }

    /**
     * Method assignDate
     *
     * @param Carbon $date
     * @param string $eventId
     *
     * @return void
     */
    public function assignDate(Carbon $date, string $eventId)
    {
        $dbDate = PlayDate::where('play_id', $this->id)
            ->where('played_at', $date)
            ->first();


        if (!$dbDate)
            PlayDate::create([
                'play_id' => $this->id,
                'played_at' => $date,
                'google_calendar_id' => $eventId
            ]);
    }

public function dates(): HasMany
{
    return $this->hasMany(PlayDate::class)->orderBy('played_at');
}


    public function crew(): HasMany
    {
        return $this->hasMany(PlayEmployee::class)
            ->join('employees', 'play_employees.employee_id', '=', 'employees.id')
            ->orderBy('employees.name')
            ->select('play_employees.*');
    }

    public function images(): HasMany
    {
        return $this->hasMany(PlayImage::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'play_categories');
    }

    public function scopeSearch($query, $value)
    {
        if ($value) {
            $words = explode(' ', $value);

            return $query->where(function ($q) use ($words) {
                foreach ($words as $word) {
                    $q->where('title', 'like', "%{$word}%");
                }
            });
        }

        return $query;
    }
}
