<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ArchiveController extends Controller
{
    public function plays(){
        return view('user.archive.archive_plays');
    }

    public function repertoires(){
        return view('user.archive.archive_repertoire');
    }
}
