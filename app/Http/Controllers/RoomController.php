<?php

namespace App\Http\Controllers;

use app\Http\Helper;
use App\Room;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;


class RoomController extends Controller
{
    public function index()
    {
        return view('import.room');
    }

    public function import()
    {
        self::importFile();

        return redirect('import/room');
    }

    private static function truncate()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Room::truncate();

        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }


    public static function importFile()
    {

        if (!Request::capture()->hasFile('roomFile')) return false;
        $myfile = fopen(Request::capture()->file('roomFile')->getPathname(), 'r');
        $fullText = explode("\n", trim(utf8_encode(fread($myfile, Request::capture()->file('roomFile')->getSize()))));
        fclose($myfile);
        if (!self::validateFile($fullText)) return false;
        self::truncate();

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $room = new Room();
                $room->id = Helper::issetAndFullOrNull($lineArr[0]);
                $room->name = Helper::issetAndFullOrNull($lineArr[1]);
                if ($room->save()) {
                    //  error_log('OK');
                } else {
                    error_log('KO');
                    error_log(print_r($lineArr, true));
                }

                unset($room);

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

    public function getAll()
    {
        return view('json', ['data' => Room::all()]);
    }

}
