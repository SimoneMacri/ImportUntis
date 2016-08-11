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

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public static function importFile()
    {

        $myfile = fopen(Request::capture()->file('subjectFile')->getPathname(), 'r');
        $fullText = explode("\n", utf8_encode(fread($myfile, Request::capture()->file('subjectFile')->getSize())));
        fclose($myfile);

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $subject = new Subject();
                $subject->id = Helper::issetOrNull($lineArr[0]);
                $subject->name = Helper::issetOrNull($lineArr[1]);
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
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAll()
    {
        return view('json', ['data' => Subject::all()]);
    }
}
