<?php

namespace App\Http\Controllers;

use app\Http\Helper;
use App\Room;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;

class RoomController extends Controller
{
    public function index()
    {
        return view('import.room');
    }

    public function import()
    {

        $myfile = fopen(Request::capture()->file('roomFile')->getPathname(), 'r');
        $fullText = explode("\n", utf8_encode(fread($myfile, Request::capture()->file('roomFile')->getSize())));
        fclose($myfile);

        foreach ($fullText as $line) {
            try {
                $lineArr = explode("\t", $line);
                //error_log(print_r($lineArr, true));

                $room = new Room();
                $room->id = Helper::issetOrNull($lineArr[0]);
                $room->name = Helper::issetOrNull($lineArr[1]);
                if ($room->save()) {
                    error_log('OK');
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
        return redirect('import/room');
    }

    public function getAll()
    {
        return view('json', ['data' => Room::all()]);
    }

}
