<?php

namespace App\Http\Controllers;

use App\Classe;
use app\Http\Helper;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


/**
 * Class ClasseController
 * @package App\Http\Controllers
 */
class ClasseController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('import.classe');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function import()
    {
        self::importFile();

        return redirect('import/classe');
    }

    private static function truncate()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Classe::truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Metodo che importa i il file passatogli in POST chiamato classeFile
     */
    public static function importFile()
    {
        if (!Request::capture()->hasFile('classeFile')) return false;
        $myfile = fopen(Request::capture()->file('classeFile')->getPathname(), 'r');
        $fullText = explode("\n", trim(utf8_encode(fread($myfile, Request::capture()->file('classeFile')->getSize()))));
        fclose($myfile);
        if (!self::validateFile($fullText)) return false;
        self::truncate();

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $class = new Classe();
                $class->id = Helper::issetAndFullOrNull($lineArr[0]);
                $class->name = Helper::issetAndFullOrNull($lineArr[1]);
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
        return view('json', ['data' => Classe::all()]);
    }
}
