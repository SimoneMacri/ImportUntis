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

    private static function truncate()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Date::truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public static function importFile()
    {


        if (!Request::capture()->hasFile('dateFile')) return false;
        $myfile = fopen(Request::capture()->file('dateFile')->getPathname(), 'r');
        $fullText = explode("\n", trim(utf8_encode(fread($myfile, Request::capture()->file('dateFile')->getSize()))));
        fclose($myfile);
        if (!self::validateFile($fullText)) return false;
        self::truncate();

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $date = new Date();
                $date->id = Helper::issetAndFullOrNull($lineArr[0]);
                $date->first_day_week = Helper::issetAndFullOrNull($lineArr[2]);
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
        return true;
    }

    private static function validateFile($fileText)
    {
        foreach ($fileText as $line) {
            $lineArr = explode("\t", $line);
            if (!isset($lineArr[0])) return false;
            if (!isset($lineArr[2])) return false;
        }
        return true;
    }

    public function getAll()
    {
        return view('json', ['data' => Date::orderBy('first_day_week', 'ASC')->get()]);
    }
}
