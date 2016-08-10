<?php

namespace App\Http\Controllers;

use app\Http\Helper;
use App\Lessons;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;

class LessonController extends Controller
{
    //TO_DO
    public function index()
    {
        return view('import.lessons');
    }

    public function import()
    {

        $myfile = fopen(Request::capture()->file('lessonFile')->getPathname(), 'r');
        $fullText = explode("\n", utf8_encode(fread($myfile, Request::capture()->file('lessonFile')->getSize())));
        fclose($myfile);

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $lesson = new Lessons();
                $lesson->teacher_id = Helper::issetOrNull($lineArr[0]);
                $lesson->day_id = Helper::issetOrNull($lineArr[1]);
                $lesson->hour_id = Helper::issetOrNull($lineArr[2]);
                $lesson->subject_id = Helper::issetOrNull($lineArr[3]);
                $lesson->room_id = Helper::issetOrNull($lineArr[4]);
                $lesson->class_id = Helper::issetOrNull($lineArr[7]);
                $lesson->weeks = Helper::issetOrNull($lineArr[8]);

                if ($lesson->saveOrFail()) {
                   // error_log('OK');
                }

                unset($lesson);

            } catch (QueryException $e) {
                unset($lesson);
                error_log($e->getMessage());
            }
        }
        return redirect("import/lesson");
    }

    public function getAll()
    {
        return view('json', ['data' => Lessons::all()]);
    }
}
