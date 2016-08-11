@extends('master')
@section('content')
    {!! Form::open(array( 'method'=> 'POST', 'url'=> URL::asset('/').'import/lesson/loadFile', 'class'=>'form', 'enctype'=>'multipart/form-data')) !!}
    {!! Form::label('lessonFile', 'Lesson.txt:', ['class' => 'control-label']) !!}<br>
    {!! Form::file('lessonFile',['class'=>'form-control']) !!}
        {!! Form::submit('Invia',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@stop