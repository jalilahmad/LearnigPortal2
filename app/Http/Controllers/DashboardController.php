<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function loadTeacherTable(){

        return view('dashboard.teachertable');
    }
    public function loadLearnerTable(){

        return view('dashboard.learnertable');
    }
    public function loadCourseTable(){

        return view('dashboard.coursetable');
    }
    public function loadEpisodeTable(){

        return view('dashboard.episodetable');
    }
    public function loadUnapprovedTable(){

        return view('dashboard.unapprovedtable');
    }
}
