<?php

namespace App\Http\Controllers;

use app\Http\Helper;
use App\Subject;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class SubjectController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('import.subject');
    }

    public function import()
    {
        self::importFile();

        return redirect('import/subject');
    }

    private static function truncate()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Subject::truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }



    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public static function importFile()
    {

        if (!Request::capture()->hasFile('subjectFile')) return false;
        $myfile = fopen(Request::capture()->file('subjectFile')->getPathname(), 'r');
        $fullText = explode("\n", trim(utf8_encode(fread($myfile, Request::capture()->file('subjectFile')->getSize()))));
        fclose($myfile);
        if (!self::validateFile($fullText)) return false;
        self::truncate();

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $subject = new Subject();
                $subject->id = Helper::issetAndFullOrNull($lineArr[0]);
                $subject->name = Helper::issetAndFullOrNull($lineArr[1]);
                if ($subject->save()) {
                    // error_log('OK');
                } else {
                    error_log('KO');
                    error_log(print_r($lineArr, true));
                }

                unset($subject);

            } catch (QueryException $e) {
                unset($subject);
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
        }
        return true;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAll()
    {
        return view('json', ['data' => Subject::all()]);
    }
}
