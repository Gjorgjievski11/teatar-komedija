<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index()
    {
        return view('user.activities.index');
    }

    public function show(Request $request)
    {
        $activity = Activity::with('images')->where('id',$request->id)->first();

        if($activity->category_id == 1){
            return view('user.activities.project', compact('activity'));
        }
        else if($activity->category_id == 2){
            return view('user.activities.guesting', compact('activity'));
        }
        else if($activity->category_id == 3){
            return view('user.activities.promotion', compact('activity'));
        }
        else if($activity->category_id == 4){
            return view('user.activities.publisher_activity', compact('activity'));
        }
    }
}
