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

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public static function importFile()
    {

        $myfile = fopen(Request::capture()->file('teacherFile')->getPathname(), 'r');
        $fullText = explode("\n", utf8_encode(fread($myfile, Request::capture()->file('teacherFile')->getSize())));
        fclose($myfile);

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $teacher = new Teacher();
                $teacher->id = Helper::issetOrNull($lineArr[0]);
                $teacher->name = Helper::issetOrNull($lineArr[1]);
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
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAll()
    {
        return view('json', ['data' => Teacher::all()]);
    }
}
