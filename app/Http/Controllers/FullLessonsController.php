<?php

namespace App\Http\Controllers;

use App\Classe;
use App\DayOfWeek;
use App\FullLessons;
use App\Http\Requests\Request;
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
    }

    public function index()
    {
        return view('import.all');
    }

    public function import()
    {
        $error = array();
        if (!ClasseController::importFile()) {
            $error[] = 'Class Import error';
        }
        if (!DateController::importFile()) {
            $error[] = 'Date Import error';
        }
        if (!RoomController::importFile()) {
            $error[] = 'Room Import error';
        }
        if (!SubjectController::importFile()) {
            $error[] = 'Subject Import error';
        }
        if (!TeacherController::importFile()) {
            $error[] = 'Teacher Import error';
        }
        if (!TimeController::importFile()) {
            $error[] = 'Time Import error';
        }
        if (!LessonController::importFile()) {
            $error[] = 'Lesson Import error';
        }
        $success = "";
        if (count($error) <= 0) {
            $success = 'Caricamento avvenuto con successo';
        }

        return view('import.all')->with('error', $error)->with('success', $success);
    }

    /**
     * @param $classe
     * @param $date
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLessonsClasse($classe, $date)
    {
        /**
         * @var $tmp Lessons[]
         */
        $lessons = Classe::find($classe)->lessons()->whereDateId($date)->orderBy('day_id')->orderBy('hour_id')->get(
            ['teacher_id',
                'teacher_name',
                'room_id',
                'room_name',
                'subject_id',
                'subject_name',
                'date_id',
                'day_id',
                'hour_id',
                'start',
                'finish']);

        $ret = array();

        $lessons = $this->organizeLessonsForClasse($lessons, false);
        foreach ($lessons as $lesson) {
            /* echo $lesson->start;
             echo " - ";
             echo (strtotime($lesson->start)%86400) /60;
             echo " - ";
             echo date("d/m/Y H:i:s", strtotime($lesson->start)) ;
             echo "<br>";*/

            $ret[$lesson->day_id][] = $lesson;

        }

        /* foreach ($tmp as $lessons) {

             $data[$lessons->start_hour][$lessons->day_id] = $lessons;
         }*/

        //return \Response::json($ret);
        return view("showLessons", ['lessons' => $ret, 'times' => Time::distinct()->get(['start_hour', 'finish_hour']), 'days' => DayOfWeek::all()]);
    }

    public function showLessonsTeacher($teacher, $date)
    {

        /**
         * @var $tmp Lessons[]
         */
        $lessons = Teacher::find($teacher)->lessons()->whereDateId($date)->orderBy('day_id')->orderBy('hour_id')->get(
            ['classe_id',
                'classe_name',
                'room_id',
                'room_name',
                'subject_id',
                'subject_name',
                'date_id',
                'day_id',
                'hour_id',
                'start',
                'finish']
        );
        $ret = array();

        $lessons = $this->organizeLessonsForTeacher($lessons, false);
        foreach ($lessons as $lesson) {
            /* echo $lesson->start;
             echo " - ";
             echo (strtotime($lesson->start)%86400) /60;
             echo " - ";
             echo date("d/m/Y H:i:s", strtotime($lesson->start)) ;
             echo "<br>";*/

            $ret[$lesson->day_id][] = $lesson;

        }

        //return \Response::json($ret);


        // die();

        return view("showLessons", ['lessons' => $ret, 'times' => Time::distinct()->get(['start_hour', 'finish_hour']), 'days' => DayOfWeek::all()]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function all()
    {


        ini_set('memory_limit', '2G');
        ini_set('max_execution_time', 600); //600 seconds = 10 minutes
        $lessons = FullLessons::orderBy('start')->orderBy('teacher_id')->get();
        return \Response::json($this->organizeLessonsForTeacher($lessons));
    }

    /**
     * @param $teacher
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teacher($teacher)
    {
        $lessons = FullLessons::whereTeacherId($teacher)->orderBy('start')->orderBy('classe_id')->get(
            ['classe_id',
                'classe_name',
                'room_id',
                'room_name',
                'subject_id',
                'subject_name',
                'date_id',
                'day_id',
                'hour_id',
                'start',
                'finish']);
        return \Response::json($this->organizeLessonsForTeacher($lessons));
    }

    /**
     * @param $classe
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function classe($classe)
    {
        $lessons = FullLessons::whereClasseId($classe)->orderBy('start')->orderBy('teacher_id')->get(
            ['teacher_id',
                'teacher_name',
                'room_id',
                'room_name',
                'subject_id',
                'subject_name',
                'date_id',
                'day_id',
                'hour_id',
                'start',
                'finish']);
        return \Response::json($this->organizeLessonsForClasse($lessons));
    }

    /**
     * @param $classe
     * @param $dateId
     * @param $dayId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function classePerDay($classe, $dateId, $dayId)
    {
        $lessons = FullLessons::whereClasseId($classe)->whereDateId($dateId)->whereDayId($dayId)->orderBy('start')->orderBy('teacher_id')->get(
            ['teacher_id',
                'teacher_name',
                'room_id',
                'room_name',
                'subject_id',
                'subject_name',
                'date_id',
                'day_id',
                'hour_id',
                'start',
                'finish']);
        return \Response::json($this->organizeLessonsForClasse($lessons));
    }

    /**
     * @param $teacher
     * @param $dateId
     * @param $dayId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function teacherPerDay($teacher, $dateId, $dayId)
    {
        $lessons = FullLessons::whereTeacherId($teacher)->whereDateId($dateId)->whereDayId($dayId)->orderBy('start')->orderBy('classe_id')->get(
            ['teacher_id',
                'teacher_name',
                'room_id',
                'room_name',
                'subject_id',
                'subject_name',
                'date_id',
                'day_id',
                'hour_id',
                'start',
                'finish']);
        return \Response::json($this->organizeLessonsForTeacher($lessons));
    }


    /**
     *
     * Funzione che organizza l'export JSON delel lezioni per le classi
     * @param $lessons FullLessons[]
     * @return \App\FullLessons[]
     */
    private function organizeLessonsForClasse($lessons, $reduceData = true)
    {
        /**
         * @var $retArr FullLessons[]
         * @var $less FullLessons
         * @var $tmp FullLessons
         */
        $retArr = array();
        $tmp = null;
        foreach ($lessons as $less) {
            if (is_null($tmp)) {
                $tmp = $less;
                $tmp->startHourId = $less->hour_id;
                $tmp->detail[$less->teacher_id] = new \stdClass();
                $tmp->detail[$less->teacher_id]->teacherId = $less->teacher_id;
                $tmp->detail[$less->teacher_id]->teacherName = $less->teacher_name;
                $tmp->detail[$less->teacher_id]->roomId = $less->room_id;
                $tmp->detail[$less->teacher_id]->roomName = $less->room_name;
            } else {
                if ($tmp->subject_id == $less->subject_id) {
                    if ($tmp->date_id == $less->date_id) {
                        if ($tmp->day_id == $less->day_id) {
                            if ($tmp->teacher_id == $less->teacher_id) {
                                if ($tmp->hour_id + 1 == $less->hour_id) { // verifico se è l'ora successiva
                                    $tmp->hour_id = $less->hour_id;
                                    $tmp->finish = $less->finish;
                                    continue;
                                }
                            } else {
                                if ($tmp->hour_id == $less->hour_id) { // gestisco la situazione di più professori e aule per la stessa lezione
                                    $tmp->detail[$less->teacher_id] = new \stdClass();
                                    $tmp->detail[$less->teacher_id]->teacherId = $less->teacher_id;
                                    $tmp->detail[$less->teacher_id]->teacherName = $less->teacher_name;
                                    $tmp->detail[$less->teacher_id]->roomId = $less->room_id;
                                    $tmp->detail[$less->teacher_id]->roomName = $less->room_name;
                                    continue;
                                }
                            }
                        }
                    }
                }
                if ($reduceData) {
                    //alleggerisco la chiamata eliminando il superfluo
                    unset($tmp->teacher_name);
                    unset($tmp->teacher_id);
                    unset($tmp->room_id);
                    unset($tmp->room_name);
                    unset($tmp->date_id);
                    unset($tmp->day_id);
                    unset($tmp->hour_id);
                    unset($tmp->startHourId);
                }
                if ($tmp != null)
                    $retArr[] = $tmp;
                $tmp = $less;
                $tmp->startHourId = $less->hour_id;
                $tmp->detail[$less->teacher_id] = new \stdClass();
                $tmp->detail[$less->teacher_id]->teacherId = $less->teacher_id;
                $tmp->detail[$less->teacher_id]->teacherName = $less->teacher_name;
                $tmp->detail[$less->teacher_id]->roomId = $less->room_id;
                $tmp->detail[$less->teacher_id]->roomName = $less->room_name;
            }

        }
        if ($reduceData) {
            //alleggerisco la chiamata eliminando il superfluo
            unset($tmp->teacher_name);
            unset($tmp->teacher_id);
            unset($tmp->room_id);
            unset($tmp->room_name);
            unset($tmp->date_id);
            unset($tmp->day_id);
            unset($tmp->hour_id);
            unset($tmp->startHourId);
        }
        if ($tmp != null)
            $retArr[] = $tmp;
        return $retArr;
    }

    /**
     * Funzione che organizza l'export JSON delel lezioni per i Professori
     * @param $lessons FullLessons[]
     * @return \App\FullLessons[]
     */
    private function organizeLessonsForTeacher($lessons, $reduceData = true)
    {
        /**
         * @var $retArr FullLessons[]
         * @var $less FullLessons
         * @var $tmp FullLessons
         */
        //return $lessons;
        $retArr = array();
        $tmp = null;
        foreach ($lessons as $less) {
            if (is_null($tmp)) {
                $tmp = $less;
                $tmp->startHourId = $less->hour_id;
                $tmp->detail[$less->classe_id] = new \stdClass();
                $tmp->detail[$less->classe_id]->classeId = $less->classe_id;
                $tmp->detail[$less->classe_id]->classeName = $less->classe_name;
                $tmp->detail[$less->classe_id]->roomId = $less->room_id;
                $tmp->detail[$less->classe_id]->roomName = $less->room_name;
            } else {
                if ($tmp->subject_id == $less->subject_id) {
                    if ($tmp->date_id == $less->date_id) {
                        if ($tmp->day_id == $less->day_id) {
                            if ($tmp->classe_id == $less->classe_id) {
                                if ($tmp->hour_id + 1 == $less->hour_id) { // verifico se è l'ora successiva
                                    $tmp->hour_id = $less->hour_id;
                                    $tmp->finish = $less->finish;
                                    continue;
                                }
                            } else {
                                if ($tmp->hour_id == $less->hour_id) { // gestisco la situazione di più professori e aule per la stessa lezione
                                    $tmp->detail[$less->classe_id] = new \stdClass();
                                    $tmp->detail[$less->classe_id]->classeId = $less->classe_id;
                                    $tmp->detail[$less->classe_id]->classeName = $less->classe_name;
                                    $tmp->detail[$less->classe_id]->roomId = $less->room_id;
                                    $tmp->detail[$less->classe_id]->roomName = $less->room_name;
                                    continue;
                                }
                            }
                        }
                    }
                }
                if ($reduceData) {
                    //alleggerisco la chiamata eliminando il superfluo
                    unset($tmp->classe_id);
                    unset($tmp->classe_name);
                    unset($tmp->room_id);
                    unset($tmp->room_name);
                    unset($tmp->date_id);
                    unset($tmp->day_id);
                    unset($tmp->hour_id);
                    unset($tmp->startHourId);
                }
                if ($tmp != null)
                    $retArr[] = $tmp;
                $tmp = $less;
                $tmp->startHourId = $less->hour_id;
                $tmp->detail[$less->classe_id] = new \stdClass();
                $tmp->detail[$less->classe_id]->classeId = $less->classe_id;
                $tmp->detail[$less->classe_id]->classeName = $less->classe_name;
                $tmp->detail[$less->classe_id]->roomId = $less->room_id;
                $tmp->detail[$less->classe_id]->roomName = $less->room_name;
            }

        }

        if ($reduceData) {
            //alleggerisco la chiamata eliminando il superfluo
            unset($tmp->classe_id);
            unset($tmp->classe_name);
            unset($tmp->room_id);
            unset($tmp->room_name);
            unset($tmp->date_id);
            unset($tmp->day_id);
            unset($tmp->hour_id);
            unset($tmp->startHourId);
        }

        //inserisco l'ultimo elemento
        if ($tmp != null)
            $retArr[] = $tmp;
        return $retArr;
    }
}
