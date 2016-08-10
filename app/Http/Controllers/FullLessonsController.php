<?php

namespace App\Http\Controllers;

use App\Classe;
use App\FullLessons;
use App\Teacher;
use Illuminate\Http\Request;

use App\Http\Requests;

class FullLessonsController extends Controller
{
    public function __costructor()
    {
        ini_set('memory_limit', '256M');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('json', ['data' => FullLessons::all()]);
    }

    /**
     * @param $teacher
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teacher($teacher)
    {
        return view('json', ['data' => Teacher::find($teacher)->lessons]);
    }

    /**
     * @param $classe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function classe($classe)
    {
        return view('json', ['data' => Classe::find($classe)->lessons]);
    }
}
