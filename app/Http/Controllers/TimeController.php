<?php

namespace App\Http\Controllers;

use app\Http\Helper;
use App\Time;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;

class TimeController extends Controller
{
    public function index()
    {
        return view('import.time');
    }

    public function import()
    {

        $myfile = fopen(Request::capture()->file('timeFile')->getPathname(), 'r');
        $fullText = explode("\n", utf8_encode(fread($myfile, Request::capture()->file('timeFile')->getSize())));
        fclose($myfile);

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $time = new Time();
                $time->day_id = Helper::issetOrNull($lineArr[0]);
                $time->hour_id = Helper::issetOrNull($lineArr[1]);
                $time->start_hour = Helper::issetOrNull($lineArr[3]);
                $time->finish_hour = Helper::issetOrNull($lineArr[4]);
                if ($time->save()) {
                   // error_log('OK');
                } else {
                    error_log('KO');
                    error_log(print_r($lineArr, true));
                }
                unset($time);

            } catch (QueryException $e) {
                unset($time);
                error_log($e->getMessage());
            }
        }
        return redirect('import/time');
    }

    public function getAll()
    {
        return view('json', ['data' => Time::all()]);
    }
}
