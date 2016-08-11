<?php

namespace App\Http\Controllers;

use App\Date;
use app\Http\Helper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DateController extends Controller
{

    public function index()
    {
        return view('import.date');
    }

    public function import()
    {
        self::importFile();

        return redirect('import/date');
    }

    public static function importFile()
    {

        $myfile = fopen(Request::capture()->file('dateFile')->getPathname(), 'r');
        $fullText = explode("\n", utf8_encode(fread($myfile, Request::capture()->file('dateFile')->getSize())));
        fclose($myfile);

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $date = new Date();
                $date->id = Helper::issetOrNull($lineArr[0]);
                $date->first_day_week = Helper::issetOrNull($lineArr[2]);
                if ($date->saveOrFail()) {
                    //error_log('OK');
                } else {
                    error_log('KO');
                    error_log(print_r($lineArr, true));
                }

                unset($date);

            } catch (QueryException $e) {
                unset($room);
                error_log($e->getMessage());
            }
        }
    }

    public function getAll()
    {
        return view('json', ['data' => Date::all()]);
    }
}
