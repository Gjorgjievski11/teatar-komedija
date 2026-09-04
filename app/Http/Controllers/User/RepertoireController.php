<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Play;
use Carbon\Carbon;

class RepertoireController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $nextMonth = $now->copy()->addMonth();
        $currentMonth = $now->month;
        $currentYear = $now->year;

        $plays = Play::with(['dates', 'categories'])->get();

        // Map plays to include precomputed date logic
        $plays->transform(function ($play) use ($now, $nextMonth, $currentMonth, $currentYear) {
            $futureDates = $play->dates->filter(fn($date) => Carbon::parse($date->played_at)->isFuture());

            $premiereDate = $play->dates->sortBy('played_at')->first();
            $premiereDateCarbon = $premiereDate ? Carbon::parse($premiereDate->played_at) : null;

            $isPremiereUpcomingThisOrNextMonth = $premiereDateCarbon
                ? $premiereDateCarbon->isFuture() &&
                  ($premiereDateCarbon->month === $currentMonth || $premiereDateCarbon->month === $nextMonth->month)
                : false;

            $nextMonthDates = $futureDates->filter(function($date) use ($nextMonth) {
                $playedAt = Carbon::parse($date->played_at);
                return $playedAt->month === $nextMonth->month && $playedAt->year === $nextMonth->year;
            });

            return array_merge($play->toArray(), [
                'future_dates' => $futureDates->values(),
                'premiere_date' => $premiereDate,
                'is_premiere_upcoming' => $isPremiereUpcomingThisOrNextMonth,
                'next_month_dates' => $nextMonthDates->values(),
            ]);
        });

        return view('user.repertoire.index', compact('plays'));
    }
}
