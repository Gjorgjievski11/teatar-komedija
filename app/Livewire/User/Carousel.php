<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Play;

class Carousel extends Component
{


    public function render()
    {

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $now = Carbon::now();

        $plays = Play::with('categories')->whereHas('dates', function ($query) use ($now, $currentMonth, $currentYear) {
            $query->whereRaw('played_at = (
                    SELECT MIN(d2.played_at)
                    FROM play_dates d2
                    WHERE d2.play_id = play_dates.play_id
                )')
                ->whereMonth('played_at', $currentMonth)
                ->whereYear('played_at', $currentYear)
                ->where('played_at', '>', $now);
        })->limit(3)->get();


        return view('livewire.user.carousel', [
            'plays' => $plays ?? collect([]),
        ]);
    }
}
