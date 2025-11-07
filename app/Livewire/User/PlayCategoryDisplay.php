<?php

namespace App\Livewire\User;

use App\Models\Category;
use App\Models\Play;
use Carbon\Carbon;
use Livewire\Attributes\Url;
use Livewire\Component;

class PlayCategoryDisplay extends Component
{
    #[Url('q')]
    public $category = 'premieres';

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function render()
    {
        $now = Carbon::now();
        $nextMonth = $now->copy()->addMonth();
        $currentMonth = $now->month;
        $currentYear = $now->year;

        if ($this->category === 'premieres') {
            $plays = Play::with('dates')->whereHas('dates', function ($query) use ($now, $currentMonth, $currentYear) {
                $query->whereRaw('played_at = (
                    SELECT MIN(d2.played_at)
                    FROM play_dates d2
                    WHERE d2.play_id = play_dates.play_id
                )')
                ->whereMonth('played_at', $currentMonth)
                ->whereYear('played_at', $currentYear)
                ->where('played_at', '>', $now);
            })->get();
        } elseif ($this->category === 'plays') {
            $plays = Play::with('dates')->whereHas('dates', function ($query) use ($currentMonth, $currentYear) {
                $query->whereMonth('played_at', $currentMonth)
                      ->whereYear('played_at', $currentYear);
            })->get();
        } else {
            $plays = Play::with('dates')->whereHas('categories', function ($query) {
                $query->where('categories.id', Category::NAKED_MOON);
            })->get();
        }

        // Move **exact Blade logic** into Livewire
        $plays->transform(function ($play) use ($now, $nextMonth) {

            // All future dates
            $futureDates = $play->dates->filter(function($date) use ($now) {
                return Carbon::parse($date->played_at)->isFuture();
            });

            // Premiere
            $premiereDate = $play->dates->sortBy('played_at')->first();
            $premiereDateCarbon = $premiereDate ? Carbon::parse($premiereDate->played_at) : null;

            // Premiere upcoming this or next month
            $isPremiereUpcomingThisOrNextMonth = $premiereDateCarbon
                ? $premiereDateCarbon->isFuture() &&
                  ($premiereDateCarbon->month === Carbon::now()->month || $premiereDateCarbon->month === $nextMonth->month)
                : false;

            // Future dates in next month
            $nextMonthDates = $futureDates->filter(function($date) use ($nextMonth) {
                $playedAt = Carbon::parse($date->played_at);
                return $playedAt->month === $nextMonth->month && $playedAt->year === $nextMonth->year;
            });

            return array_merge($play->toArray(), [
                'futureDates' => $futureDates->values(),
                'premiereDate' => $premiereDate,
                'isPremiereUpcomingThisOrNextMonth' => $isPremiereUpcomingThisOrNextMonth,
                'nextMonthDates' => $nextMonthDates->values(),
            ]);
        });

        return view('livewire.user.play-category-display', [
            'plays' => $plays,
            'category' => $this->category,
        ]);
    }
}
