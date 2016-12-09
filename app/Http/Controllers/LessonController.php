<?php

namespace App\Http\Controllers;

use app\Http\Helper;
use App\Lessons;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class LessonController extends Controller
{
    //TO_DO
    public function index()
    {
        return view('import.lessons');
    }

    public function import()
    {
        self::importFile();

        return redirect('import/lesson');
    }

    private static function truncate()
    {

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Lessons::truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }


    public static function importFile()
    {

        if (!Request::capture()->hasFile('lessonFile')) return false;
        $myfile = fopen(Request::capture()->file('lessonFile')->getPathname(), 'r');
        $fullText = explode("\n", trim(utf8_encode(fread($myfile, Request::capture()->file('lessonFile')->getSize()))));
        fclose($myfile);
        if (!self::validateFile($fullText)) return false;
        self::truncate();

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $lesson = new Lessons();
                $lesson->teacher_id = Helper::issetAndFullOrNull($lineArr[0]);
                $lesson->day_id = Helper::issetAndFullOrNull($lineArr[1]);
                $lesson->hour_id = Helper::issetAndFullOrNull($lineArr[2]);
                $lesson->subject_id = Helper::issetAndFullOrNull($lineArr[3]);
                $lesson->room_id = Helper::issetAndFullOrNull($lineArr[4]);
                $lesson->class_id = Helper::issetAndFullOrNull($lineArr[7]);
                $lesson->weeks = Helper::issetAndFullOrNull($lineArr[8]);

                if ($lesson->saveOrFail()) {
                    // error_log('OK');
                }

                unset($lesson);

            } catch (QueryException $e) {
                unset($lesson);
                error_log($e->getMessage());
            }
        }
        return true;
    }

    private static function validateFile($fileText)
    {
        foreach ($fileText as $line) {
            $lineArr = explode("\t", $line);
            if (!isset($lineArr[0])) return false;
            if (!isset($lineArr[1])) return false;
            if (!isset($lineArr[2])) return false;
            if (!isset($lineArr[3])) return false;
            if (!isset($lineArr[4])) return false;
            if (!isset($lineArr[7])) return false;
            if (!isset($lineArr[8])) return false;
        }
        return true;
    }

    public function getAll()
    {
        return view('json', ['data' => Lessons::all()]);
    }
}
