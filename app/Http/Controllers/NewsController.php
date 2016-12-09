<?php

namespace App\Http\Controllers;

use App\Classe;
use app\Http\Helper;
use App\News;
use App\Teacher;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\UploadedFile;

class NewsController extends Controller
{

    public function create()
    {
        return $this->edit(-1);
    }


    public function newsList()
    {
        return view('news.newsList')->with('news', News::all());
    }

    public function newsDetail(Request $request)
    {
        $news = News::find($request->get('id_news'));

        return \Response::json($news);
    }

    public function newsDelete(Request $request, $news_id)
    {
        $news = News::find($news_id);
        $news->delete();
        return back();
    }

    public function edit($newsId)
    {
        $classi = Classe::get(['id', 'name'])->pluck('name', 'id')->map(
            function ($item, $key) {
                return "$key - $item";
            });

        $teachers = Teacher::get(['id', 'name'])->pluck('name', 'id')->map(
            function ($item, $key) {
                return "$key - $item";
            });

        $news = News::findOrNew($newsId);
        $news->classi = $news->classi()->get(['id', 'name'])->pluck('name', 'id')->map(
            function ($item, $key) {
                return "$key - $item";
            });
        $news->teacher = $news->teacher()->get(['id', 'name'])->pluck('name', 'id')->map(
            function ($item, $key) {
                return "$key - $item";
            });

        $classi = Classe::whereNotIn('id', $news->classi->keys())->pluck('name', 'id')->map(
            function ($item, $key) {
                return "$key - $item";
            });

        $teachers = Teacher::whereNotIn('id', $news->teacher->keys())->pluck('name', 'id')->map(
            function ($item, $key) {
                return "$key - $item";
            });

        /*echo "<pre>";
        print_r(Classe::whereNotIn('id', $news->classi->keys())->pluck('name', 'id')->map(
            function ($item, $key) {
                return "$key - $item";
            }));
        echo "</pre>";
        die();*/

        return view('news.edit')->with('classi', $classi->toArray())->with('teachers', $teachers->toArray())->with('news', $news);
    }


    public function store($newsId = null)
    {
        ini_set('memory_limit', '2G');
        ini_set('upload_max_filesize', '100M');
        ini_set('post_max_size', '100M');


        $request = Request::capture();
        $data = $request->all();

        /*
         * @var $news News
         */
        $news = News::findOrNew($newsId);
        $news->title = Helper::issetAndFullOrNull($data['title']);
        $news->description = Helper::issetAndFullOrNull($data['description']);
        $news->start_date = Helper::issetAndFullOrNull($data['start_date']);
        $news->finish_date = Helper::issetAndFullOrNull($data['finish_date']);
        $news->important = Helper::issetOrNull($data['important'], 1, 0);
        $news->imgPosition = Helper::issetAndFullOrNull($data['imgPosition']);

        if ($news->save() && isset($data['imgFile'])) {
            /**
             * @var $img UploadedFile
             */
            $img = $data['imgFile'];
            //$img
            $newPath = $_SERVER['DOCUMENT_ROOT'] . env('IMG_PATH', '/img');
            $fileName = "img$news->id." . $img->getClientOriginalExtension();
            if ($newFile = $img->move($newPath, $fileName)) {
                $news->imgFilePath = $newFile->getPathname();
                $news->save();
            }
        }

        if (isset($data['classi'])) {
            $news->classi()->detach();
            $news->classi()->saveMany(Classe::findMany($data['classi']));
        }

        if (isset($data['teacher'])) {
            $news->teacher()->detach();
            $news->teacher()->saveMany(Teacher::findMany($data['teacher']));
        }

        return redirect('news/' . $news->id);
    }


    public function allNews()
    {
        $news = News::orderBy('important', 'DESC')
            ->where('start_date', '<=', date('Y-m-d'))
            ->where('finish_date', '>=', date('Y-m-d'))
            ->orderBy('start_date', 'ASC')
            ->orderBy('finish_date', 'ASC')
            ->get();
        foreach ($news as $singleNews) {
            if ($singleNews->imgFilePath && file_exists($singleNews->imgFilePath))
                $singleNews->imgFilePath = base64_encode(file_get_contents($singleNews->imgFilePath));
            else
                $singleNews->imgFilePath = null;
        }
        return view('json')->with('data', $news);
    }

    public function teacherNews($teacherId)
    {
        $news = Teacher::find($teacherId)->news()
            ->where('start_date', '<=', date('Y-m-d'))
            ->where('finish_date', '>=', date('Y-m-d'))
            ->orderBy('important', 'DESC')
            ->orderBy('start_date', 'ASC')
            ->orderBy('finish_date', 'ASC')
            ->get();

        foreach ($news as $singleNews) {
            if ($singleNews->imgFilePath && file_exists($singleNews->imgFilePath))
                $singleNews->imgFilePath = base64_encode(file_get_contents($singleNews->imgFilePath));
            else
                $singleNews->imgFilePath = null;
        }
        return \Response::json($news);
    }

    public function classeNews($classeId)
    {
        $news = Classe::find($classeId)->news()
            ->where('start_date', '<=', date('Y-m-d'))
            ->where('finish_date', '>=', date('Y-m-d'))
            ->orderBy('important', 'DESC')
            ->orderBy('start_date', 'ASC')
            ->orderBy('finish_date', 'ASC')
            ->get();


        foreach ($news as $singleNews) {
            if ($singleNews->imgFilePath && file_exists($singleNews->imgFilePath))
                $singleNews->imgFilePath = base64_encode(file_get_contents($singleNews->imgFilePath));
            else
                $singleNews->imgFilePath = null;
        }
        return \Response::json($news);
    }
}
