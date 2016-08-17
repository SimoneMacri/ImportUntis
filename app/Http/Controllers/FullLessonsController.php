<?php

namespace App\Http\Controllers;

use App\Classe;
use App\DayOfWeek;
use App\FullLessons;
use App\Lessons;
use App\Teacher;
use App\Time;

/**
 * Class FullLessonsController
 * @package App\Http\Controllers
 */
class FullLessonsController extends Controller
{
    public function __costructor()
    {
        ini_set('memory_limit', '256M');
        ini_set('max_execution_time', 0.5); //300 seconds = 5 minutes
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
     * @param $classe
     * @param $date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLessons($classe, $date)
    {
        /**
         * @var $tmp Lessons[]
         */
        $tmp = Classe::find($classe)->lessons()->whereDateId($date)->get();
        $data = array();

        foreach ($tmp as $lessons) {

            $data[$lessons->start_hour][$lessons->day_id] = $lessons;
        }
        return view("showLessons", ['lessons' => $data, 'times' => Time::distinct()->get(['start_hour', 'finish_hour']), 'days' => DayOfWeek::all()]);
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
