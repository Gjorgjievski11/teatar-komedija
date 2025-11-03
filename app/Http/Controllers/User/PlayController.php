<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Play;
use Psy\Command\WhereamiCommand;

class PlayController extends Controller
{
public function show($id)
{
    $play = Play::with([
        'dates',
        'crew.employee.jobPosition',
        'crew.employee.images',
        'crew.contributions',
        'images'
    ])->findOrFail($id);

    // Debug (optional)
    $allJobPositions = $play->crew->map(function($pe) {
        return [
            'employee_name' => $pe->employee->getFullName(),
            'job_position_id' => $pe->employee->job_position_id,
            'job_position_name' => $pe->employee->jobPosition->name ?? 'Unknown',
            'has_role_name' => !empty($pe->role_name)
        ];
    });

    $actors = $play->crew->filter(function ($pe) {
    $job = strtolower($pe->employee->jobPosition->name ?? '');
    $hasRole = filled($pe->role_name);
    $hasContributions = $pe->contributions->isNotEmpty() || !is_null($pe->contribution_id);

    $isActorByPosition = str_contains($job, 'actor') ||
                         str_contains($job, 'глумец') ||
                         str_contains($job, 'актер');

    return $hasRole || $isActorByPosition || !$hasContributions;
});

    
    // (you can leave this part as-is)
    $contributors = $play->crew->filter(function ($playEmployee) {
        return $playEmployee->contributions->isNotEmpty() ||
               !is_null($playEmployee->contribution_id);
    });

    return view('user.play.show', compact('play', 'actors', 'contributors'));
}
}
