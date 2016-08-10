<?php

namespace App\Http\Controllers;

use App\Classe;
use app\Http\Helper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;

class ClasseController extends Controller
{
    public function index()
    {
        return view('import.classe');
    }

    public function import()
    {

        $myfile = fopen(Request::capture()->file('classeFile')->getPathname(), 'r');
        $fullText = explode("\n", utf8_encode(fread($myfile, Request::capture()->file('classeFile')->getSize())));
        fclose($myfile);

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $class = new Classe();
                $class->id = Helper::issetOrNull($lineArr[0]);
                $class->name = Helper::issetOrNull($lineArr[1]);
                if ($class->saveOrFail()) {
                    //error_log('OK');
                } else {
                    error_log('KO');
                    error_log(print_r($lineArr, true));
                }

                unset($class);

            } catch (QueryException $e) {
                unset($room);
                error_log($e->getMessage());
            }
        }
        return redirect('import/classe');
    }

    public function getAll()
    {
        return view('json', ['data' => Classe::all()]);
    }
}
