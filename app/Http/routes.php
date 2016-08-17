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

Route::get('/', function () {
    return view('index');
});


Route::get('import/classe', 'ClasseController@index');
Route::post('import/classe/loadFile', ['uses' => 'ClasseController@import',]);

Route::get('import/date', 'DateController@index');
Route::post('import/date/loadFile', 'DateController@import');

Route::get('import/room', 'RoomController@index');
Route::post('import/room/loadFile', 'RoomController@import');

Route::get('import/time', 'TimeController@index');
Route::post('import/time/loadFile', 'TimeController@import');

Route::get('import/teacher', 'TeacherController@index');
Route::post('import/teacher/loadFile', 'TeacherController@import');

Route::get('import/lesson', 'LessonController@index');
Route::post('import/lesson/loadFile', 'LessonController@import');

Route::get('import/subject', 'SubjectController@index');
Route::post('import/subject/loadFile', 'SubjectController@import');

Route::get('import/all', 'FullLessonsController@index');
Route::post('import/all/loadFile', 'FullLessonsController@import');
Route::get('/showLessons/{classe}/{date}', 'FullLessonsController@showLessons');

Route::get('service/classe/list', 'ClasseController@getAll');
Route::get('service/date/list', 'DateController@getAll');
Route::get('service/room/list', 'RoomController@getAll');
Route::get('service/time/list', 'TimeController@getAll');
Route::get('service/teacher/list', 'TeacherController@getAll');

Route::get('service/full_lessons', 'FullLessonsController@all');
Route::get('service/full_lessons/classe/{id}', 'FullLessonsController@classe');
Route::get('service/full_lessons/teacher/{id}', 'FullLessonsController@teacher');