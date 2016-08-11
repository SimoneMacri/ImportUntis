<?php

namespace App\Http\Controllers;

use App\Classe;
use App\FullLessons;
use App\Teacher;

class FullLessonsController extends Controller
{
    public function __costructor()
    {
        ini_set('memory_limit', '256M');
    }

    public function index()
    {
        return view('import.all');
    }

    public function import()
    {
        ClasseController::importFile();
        DateController::importFile();
        RoomController::importFile();
        SubjectController::importFile();
        TeacherController::importFile();
        TimeController::importFile();

        LessonController::importFile();

        return redirect('import/all');
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {
        return view('json', ['data' => FullLessons::all()]);
    }

    /**
     * @param $teacher
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teacher($teacher)
    {
        return view('json', ['data' => Teacher::findOrFail($teacher)->lessons]);
    }

    /**
     * @param $classe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function classe($classe)
    {
        return view('json', ['data' => Classe::findOrFail($classe)->lessons]);
    }
}
