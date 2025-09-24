<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Play;
use App\Models\PlayDate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function getCalendarData(Request $request)
    {

        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        // Get all play dates for the specified month
        $playDates = PlayDate::with(['play', 'play.crew'])
            ->whereMonth('played_at', $month)
            ->whereYear('played_at', $year)
            ->orderBy('played_at')
            ->get();

        // Group by day and format the data
        $calendarData = [];

        foreach ($playDates as $playDate) {
            $day = Carbon::parse($playDate->played_at)->format('j'); // Day without leading zeros
            $time = Carbon::parse($playDate->played_at)->format('H:i');

            $play = $playDate->play;

            // Get author and director from crew relationships
            $author = $play->crew->where('role', 'author')->first();
            $director = $play->crew->where('role', 'director')->first();

            $calendarData[$day] = [
                'id' => $play->id,
                'title' => $play->title,
                'time' => $time,
                'photo' => $play->poster,
                'author' => $author ? $author->name : 'Непознат автор',
                'director' => $director ? $director->name : 'Непознат режисер',
                'ticket_url' => $play->ticket_url,
                'price' => $play->getPrice(),
                'description' => $play->short_description
            ];
        }

        return response()->json($calendarData);
    }
}
