<?php

namespace App\Livewire\User;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Play;
use App\Models\PlayDate;

class Carousel extends Component
{


    public function render()
    {

        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();


$plays = Play::whereHas('dates', function ($query) use ($startOfMonth, $endOfMonth) {
        $query->whereBetween('played_at', [$startOfMonth, $endOfMonth]);
    })
    ->with(['dates' => function ($query) use ($startOfMonth, $endOfMonth) {
        $query->whereBetween('played_at', [$startOfMonth, $endOfMonth])
              ->orderBy('played_at', 'asc')
              ->limit(1);
    }])
    ->orderBy(
        PlayDate::select('played_at')
            ->whereColumn('play_dates.play_id', 'plays.id')
            ->whereBetween('played_at', [$startOfMonth, $endOfMonth])
            ->orderBy('played_at', 'asc')
            ->limit(1)
    )
    ->get();

        return view('livewire.user.carousel', [
            'plays' => $plays ?? collect([]),
        ]);
    }
}
