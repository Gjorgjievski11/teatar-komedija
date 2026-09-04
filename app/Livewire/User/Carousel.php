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
        $minPlays = 3;

        // First, get plays for the current month
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

        // If we have less than the minimum, fetch upcoming plays from future months
        if ($plays->count() < $minPlays) {
            $needed = $minPlays - $plays->count();
            $existingPlayIds = $plays->pluck('id')->toArray();

            $upcomingPlays = Play::whereHas('dates', function ($query) use ($endOfMonth) {
                    $query->where('played_at', '>', $endOfMonth);
                })
                ->whereNotIn('id', $existingPlayIds)
                ->with(['dates' => function ($query) use ($endOfMonth) {
                    $query->where('played_at', '>', $endOfMonth)
                          ->orderBy('played_at', 'asc')
                          ->limit(1);
                }])
                ->orderBy(
                    PlayDate::select('played_at')
                        ->whereColumn('play_dates.play_id', 'plays.id')
                        ->where('played_at', '>', $endOfMonth)
                        ->orderBy('played_at', 'asc')
                        ->limit(1)
                )
                ->limit($needed)
                ->get();

            $plays = $plays->concat($upcomingPlays);
        }

        return view('livewire.user.carousel', [
            'plays' => $plays ?? collect([]),
        ]);
    }
}
