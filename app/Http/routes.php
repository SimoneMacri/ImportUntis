<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('index');
    });
});
*/


Route::get('/', function () {
    return view('index');
});
Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'import'], function () {
        Route::get('classe', ['as' => 'classeImportIndex', 'uses' => 'ClasseController@index']);
        Route::post('classe/loadFile', ['uses' => 'ClasseController@import',]);

        Route::get('date', ['as' => 'dateImportIndex', 'uses' => 'DateController@index']);
        Route::post('date/loadFile', 'DateController@import');

        Route::get('room', ['as' => 'roomImportIndex', 'uses' => 'RoomController@index']);
        Route::post('room/loadFile', 'RoomController@import');

        Route::get('time', ['as' => 'timeImportIndex', 'uses' => 'TimeController@index']);
        Route::post('time/loadFile', 'TimeController@import');

        Route::get('teacher', ['as' => 'teacherImportIndex', 'uses' => 'TeacherController@index']);
        Route::post('teacher/loadFile', 'TeacherController@import');

        Route::get('lesson', ['as' => 'lessonImportIndex', 'uses' => 'LessonController@index']);
        Route::post('lesson/loadFile', 'LessonController@import');

        Route::get('subject', ['as' => 'subjectImportIndex', 'uses' => 'SubjectController@index']);
        Route::post('subject/loadFile', 'SubjectController@import');

        Route::get('all', ['as' => 'allImportIndex', 'uses' => 'FullLessonsController@index']);
        Route::post('all/loadFile', 'FullLessonsController@import');
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', ['as' => 'newsIndex', 'uses' => 'NewsController@newsList']);
        Route::post('/store/{news_Id?}', ['as' => 'newsStore', 'uses' => 'NewsController@store']);
        Route::get('/{news_id}', ['as' => 'newsEdit', 'uses' => 'NewsController@edit']);
        Route::get('/new', ['as' => 'newsCreate', 'uses' => 'NewsController@edit']);
    });
});

Route::group(['prefix' => 'service'], function () {
    Route::get('classe/list', 'ClasseController@getAll');
    Route::get('date/list', 'DateController@getAll');
    Route::get('room/list', 'RoomController@getAll');
    Route::get('time/list', 'TimeController@getAll');
    Route::get('teacher/list', 'TeacherController@getAll');

    Route::group(['prefix' => 'full_lessons'], function () {
        Route::get('/', 'FullLessonsController@all');
        Route::get('classe/{id}', 'FullLessonsController@classe');
        Route::get('teacher/{id}', 'FullLessonsController@teacher');

        Route::get('classe/{id}/{date}/{day}', 'FullLessonsController@classePerDay');
        Route::get('teacher/{id}/{date}/{day}', 'FullLessonsController@teacherPerDay');
    });

    Route::group(['prefix' => 'news'], function () {
        Route::get('/', 'NewsController@allNews');
        Route::post('/', ['as' => 'newsDetail', 'uses' => 'NewsController@newsDetail']);
        Route::get('/delete/{news_id}', ['as' => 'newsDelete', 'uses' => 'NewsController@newsDelete']);
        Route::get('teacher/{teacher_id}', 'NewsController@teacherNews');
        Route::get('classe/{class_id}', 'NewsController@classeNews');
    });

    Route::group(['prefix' => 'showLessons'], function () {
        Route::get('classe/{classe}/{date}', 'FullLessonsController@showLessonsClasse');
        Route::get('teacher/{classe}/{date}', 'FullLessonsController@showLessonsTeacher');
    });
});

