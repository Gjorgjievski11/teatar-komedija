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

        // Fetch plays based on category
        if ($this->category === 'premieres') {
            $plays = Play::with('dates')->get();
        } elseif ($this->category === 'plays') {
            $currentMonth = $now->month;
            $currentYear = $now->year;

            $plays = Play::with('dates')->whereHas('dates', function ($query) use ($currentMonth, $currentYear) {
                $query->whereMonth('played_at', $currentMonth)
                    ->whereYear('played_at', $currentYear);
            })->get();
        } else {
            $plays = Play::with('dates')->whereHas('categories', function ($query) {
                $query->where('categories.id', Category::NAKED_MOON);
            })->get();
        }

        // Transform each play with computed info
        $plays->transform(function ($play) use ($now, $nextMonth) {

            $premiereDate = $play->dates->sortBy('played_at')->first();

            if ($this->category === 'premieres') {
                $isPremiere = true;
                $futureDates = collect();
                $nextMonthDates = collect();
            } else {
                $futureDates = $play->dates->filter(fn($date) => Carbon::parse($date->played_at)->isFuture());

                $nextMonthDates = $futureDates->filter(fn($date) =>
                    Carbon::parse($date->played_at)->month === $nextMonth->month &&
                    Carbon::parse($date->played_at)->year === $nextMonth->year
                );

                $isPremiere = $premiereDate
                    ? Carbon::parse($premiereDate->played_at)->isFuture() &&
                    (Carbon::parse($premiereDate->played_at)->month === $now->month ||
                    Carbon::parse($premiereDate->played_at)->month === $nextMonth->month)
                    : false;
            }

            // 🧠 Determine correct sort date
            if ($this->category === 'premieres') {
                // Sort by premiere date (newest first)
                $sortDate = $premiereDate ? Carbon::parse($premiereDate->played_at) : null;
            } else {
                // Sort by the next upcoming date (soonest future date)
                $nextPlayDate = $play->dates
                    ->filter(fn($d) => Carbon::parse($d->played_at)->isFuture())
                    ->sortBy('played_at')
                    ->first();
                $sortDate = $nextPlayDate ? Carbon::parse($nextPlayDate->played_at) : null;
            }

            return array_merge($play->toArray(), [
                'premiereDate' => $premiereDate,
                'isPremiereUpcomingThisOrNextMonth' => $isPremiere,
                'futureDates' => $futureDates->values(),
                'nextMonthDates' => $nextMonthDates->values(),
                'sortDate' => $sortDate,
            ]);
        });

        // 🧭 Sort plays depending on category
        if ($this->category === 'premieres') {
            // Newest premiere first
            $plays = $plays->sortBy('sortDate')->values();
        } else {
            // Soonest next show first
            $plays = $plays->sortBy('sortDate')->values();
        }

        return view('livewire.user.play-category-display', [
            'plays' => $plays,
            'category' => $this->category,
        ]);
    }

}
