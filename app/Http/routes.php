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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('index');
    });
});

Route::group(['prefix' => 'import'], function () {
    Route::get('classe', 'ClasseController@index');
    Route::post('classe/loadFile', ['uses' => 'ClasseController@import',]);

    Route::get('date', 'DateController@index');
    Route::post('date/loadFile', 'DateController@import');

    Route::get('room', 'RoomController@index');
    Route::post('room/loadFile', 'RoomController@import');

    Route::get('time', 'TimeController@index');
    Route::post('time/loadFile', 'TimeController@import');

    Route::get('teacher', 'TeacherController@index');
    Route::post('teacher/loadFile', 'TeacherController@import');

    Route::get('lesson', 'LessonController@index');
    Route::post('lesson/loadFile', 'LessonController@import');

    Route::get('subject', 'SubjectController@index');
    Route::post('subject/loadFile', 'SubjectController@import');

    Route::get('all', 'FullLessonsController@index');
    Route::post('all/loadFile', 'FullLessonsController@import');
});

Route::group(['prefix' => 'service'], function () {
    Route::get('classe/list', 'ClasseController@getAll');
    Route::get('date/list', 'DateController@getAll');
    Route::get('room/list', 'RoomController@getAll');
    Route::get('time/list', 'TimeController@getAll');
    Route::get('teacher/list', 'TeacherController@getAll');

    Route::get('full_lessons', 'FullLessonsController@all');
    Route::get('full_lessons/classe/{id}', 'FullLessonsController@classe');
    Route::get('full_lessons/teacher/{id}', 'FullLessonsController@teacher');

    Route::get('news/', 'NewsController@allNews');
    Route::get('news/teacher/{teacher_id}', 'NewsController@teacherNews');
    Route::get('news/classe/{class_id}', 'NewsController@classeNews');
});

Route::group(['prefix' => 'news'], function () {
    Route::get('/', 'NewsController@index');
    Route::post('/create', 'NewsController@create');
});

Route::get('/showLessons/classe/{classe}/{date}', 'FullLessonsController@showLessonsClasse');
Route::get('/showLessons/teacher/{classe}/{date}', 'FullLessonsController@showLessonsTeacher');

