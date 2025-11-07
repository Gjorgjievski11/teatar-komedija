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
        // All plays, for premiere display
        $plays = Play::with('dates')->get();
    } elseif ($this->category === 'plays') {
        $currentMonth = $now->month;
        $currentYear = $now->year;

        $plays = Play::with('dates')->whereHas('dates', function ($query) use ($currentMonth, $currentYear) {
            $query->whereMonth('played_at', $currentMonth)
                  ->whereYear('played_at', $currentYear);
        })->get();
    } else {
        // Naked Moon category
        $plays = Play::with('dates')->whereHas('categories', function ($query) {
            $query->where('categories.id', Category::NAKED_MOON);
        })->get();
    }

    // Transform plays to include precomputed date info
    $plays->transform(function ($play) use ($now, $nextMonth) {

        // Get premiere (earliest date)
        $premiereDate = $play->dates->sortBy('played_at')->first();

        if ($this->category === 'premieres') {
            // Always show premiere tag and date
            $isPremiere = true;
            $futureDates = collect(); // irrelevant for premieres
            $nextMonthDates = collect(); // irrelevant for premieres
        } else {
            // Normal plays logic
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

        return array_merge($play->toArray(), [
            'premiereDate' => $premiereDate,
            'isPremiereUpcomingThisOrNextMonth' => $isPremiere,
            'futureDates' => $futureDates->values(),
            'nextMonthDates' => $nextMonthDates->values(),
        ]);
    });

    return view('livewire.user.play-category-display', [
        'plays' => $plays,
        'category' => $this->category,
    ]);
}

}
