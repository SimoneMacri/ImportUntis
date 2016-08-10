<?php

namespace App\Http\Controllers;

use App\Date;
use app\Http\Helper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;

class DateController extends Controller
{

    public function index()
    {
        return view('import.date');
    }

    public function import()
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
                $date->data_type_1 = Helper::issetOrNull($lineArr[1]);
                $date->data_type_2 = Helper::issetOrNull($lineArr[2]);
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
        return redirect('import/date');
    }

    public function getAll()
    {
        return view('json', ['data' => Date::all()]);
    }
}
