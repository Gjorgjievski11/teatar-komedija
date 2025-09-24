<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Play;
use Psy\Command\WhereamiCommand;

class PlayController extends Controller
{
    public function show(Request $request, string $id)
    {
        $play = Play::with('crew', 'images')->where('id', $id)->first();
        $contributors = $play->crew()
            ->with('employee.jobPosition')
            ->whereHas('employee.jobPosition', function ($query) {
                $query->where('name', '!=', 'Актер');
            })
            ->get();

        $actors = $play->crew()
            ->where('job_position_id', 2)
            ->with('employee.jobPosition')
            ->get();
        // dd($actors);
        // dd($contributors, $actors);
        // dd($play->images);


        return view('user.play.show', compact('play', 'contributors', 'actors'));
    }
}
