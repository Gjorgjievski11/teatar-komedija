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
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $now = Carbon::now();

        if ($this->category === 'premieres') {
            $plays = Play::whereHas('dates', function ($query) use ($now, $currentMonth, $currentYear) {
                $query->whereRaw('played_at = (
                    SELECT MIN(d2.played_at)
                    FROM play_dates d2
                    WHERE d2.play_id = play_dates.play_id
                )')
                    ->whereMonth('played_at', $currentMonth)
                    ->whereYear('played_at', $currentYear)
                    ->where('played_at', '>', $now);
            })->get();
        } else if ($this->category === 'plays') {
            $plays = Play::whereHas('dates', function ($query) use ($currentMonth, $currentYear) {
                $query->whereMonth('played_at', $currentMonth)
                    ->whereYear('played_at', $currentYear);
            })->get();
        } else {
            $plays = Play::whereHas('categories', function ($query) {
                $query->where('categories.id', Category::NAKED_MOON);
            })->get();
        }

        return view('livewire.user.play-category-display', [
            'plays' => $plays ?? collect([]),
        ]);
    }
}
