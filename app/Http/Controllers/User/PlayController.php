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

    // Debug: See all job positions in the crew
    $allJobPositions = $play->crew->map(function($pe) {
        return [
            'employee_name' => $pe->employee->getFullName(),
            'job_position_id' => $pe->employee->job_position_id,
            'job_position_name' => $pe->employee->jobPosition->name ?? 'Unknown',
            'has_role_name' => !empty($pe->role_name)
        ];
    });

    // Get actors
    $actors = $play->crew->filter(function ($playEmployee) {
        // Check if they have a role name (actors usually have character names)
        if (!empty($playEmployee->role_name)) {
            return true;
        }
        
        // OR check job position
        $jobPositionName = strtolower($playEmployee->employee->jobPosition->name ?? '');
        return str_contains($jobPositionName, 'actor') || 
               str_contains($jobPositionName, 'глумец') ||
               str_contains($jobPositionName, 'актер');
    });

    // Get ALL contributors INCLUDING actors
    $contributors = $play->crew->filter(function ($playEmployee) {
        return $playEmployee->contributions->isNotEmpty() || 
               !is_null($playEmployee->contribution_id);
    });

    return view('user.play.show', compact('play', 'actors', 'contributors'));
}
}
