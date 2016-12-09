<?php

namespace App\Http\Controllers;

use app\Http\Helper;
use App\Time;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class TimeController extends Controller
{
    public function index()
    {
        return view('import.time');
    }

    public function import()
    {
        self::importFile();

        return redirect('import/time');
    }

    private static function truncate()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Time::truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public static function importFile()
    {

        if (!Request::capture()->hasFile('timeFile')) return false;
        $myfile = fopen(Request::capture()->file('timeFile')->getPathname(), 'r');
        $fullText = explode("\n", trim(utf8_encode(fread($myfile, Request::capture()->file('timeFile')->getSize()))));
        fclose($myfile);
        if (!self::validateFile($fullText)) return false;
        self::truncate();

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);

                $time = new Time();
                $time->day_id = Helper::issetAndFullOrNull($lineArr[0]);
                $time->hour_id = Helper::issetAndFullOrNull($lineArr[1]);
                $time->start_hour = Helper::issetAndFullOrNull($lineArr[3]);
                $time->finish_hour = Helper::issetAndFullOrNull($lineArr[4]);
                if ($time->save()) {
                   // error_log('OK');
                } else {
                    error_log('KO');
                    error_log(print_r($lineArr, true));
                }
                unset($time);

            } catch (QueryException $e) {
                unset($time);
                error_log($e->getSql());
                error_log(print_r($e->getBindings(), true));
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
            if (!isset($lineArr[3])) return false;
            if (!isset($lineArr[4])) return false;
        }
        return true;
    }

    public function getAll()
    {
        return view('json', ['data' => Time::all()]);
    }
}
