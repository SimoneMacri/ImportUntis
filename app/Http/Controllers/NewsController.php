<?php

namespace App\Http\Controllers;

use App\Classe;
use App\News;
use App\Teacher;
use Illuminate\Http\Request;

use App\Http\Requests;

class NewsController extends Controller
{

    public function index()
    {

        $classi = Classe::get(['id', 'name'])->pluck('name', 'id')->map(
            function ($item, $key) {
                return "$key - $item";
            });

        $teachers = Teacher::get(['id', 'name'])->pluck('name', 'id')->map(
            function ($item, $key) {
                return "$key - $item";
            });

        /*echo "<pre>";
        print_r($classi);
        echo "</pre>";
        die();*/

        return view('event.index')->with('classi', $classi->toArray())->with('teachers', $teachers->toArray());
    }


    public function create()
    {
        $request = Request::capture();
        $data = $request->all();


        /*echo "<pre>";
        print_r($data);
        echo "</pre>";
        die();*/
        $news = new News();
        $news->title = $data['title'];
        $news->description = $data['description'];
        $news->start_date = $data['start_date'];
        $news->finish_date = $data['finish_date'];
        $news->save();


        $news->classi()->saveMany(Classe::findMany($data['classe']));
        $news->teacher()->saveMany(Teacher::findMany($data['teacher']));

        return redirect('news/');
    }


    public function allNews()
    {
        return view('json')->with('data',
            News::orderBy('start_date', 'ASC')
                ->orderBy('finish_date', 'ASC')
                ->get());
    }

    public function teacherNews($teacherId)
    {
        sleep(2);
        return view('json')->with('data',
            Teacher::find($teacherId)->news()
                ->orderBy('start_date', 'ASC')
                ->orderBy('finish_date', 'ASC')
                ->get());
    }

    public function classeNews($classeId)
    {
        return view('json')->with('data',
            Classe::find($classeId)->news()
                ->orderBy('start_date', 'ASC')
                ->orderBy('finish_date', 'ASC')
                ->get());
    }
}
