<?php

namespace App\Http\Controllers;

use app\Http\Helper;
use App\Teacher;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


/**
 * Class TeacherController
 * @package App\Http\Controllers
 */
class TeacherController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('import.teacher');
    }

    public function import()
    {
        self::importFile();

        return redirect('import/teacher');
    }

    private static function truncate()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Teacher::truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public static function importFile()
    {
        if (!Request::capture()->hasFile('teacherFile')) return false;
        $myfile = fopen(Request::capture()->file('teacherFile')->getPathname(), 'r');
        $fullText = explode("\n", trim(utf8_encode(fread($myfile, Request::capture()->file('teacherFile')->getSize()))));
        fclose($myfile);
        if (!self::validateFile($fullText)) return false;
        self::truncate();

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $teacher = new Teacher();
                $teacher->id = Helper::issetAndFullOrNull($lineArr[0]);
                $teacher->name = Helper::issetAndFullOrNull($lineArr[1]);
                if ($teacher->save()) {
                    // error_log('OK');
                } else {
                    error_log('KO');
                    error_log(print_r($lineArr, true));
                }
                unset($teacher);

            } catch (QueryException $e) {
                unset($teacher);
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
            //if(!isset($lineArr[1])) return false;
        }
        return true;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAll()
    {
        return view('json', ['data' => Teacher::all()]);
    }
}
