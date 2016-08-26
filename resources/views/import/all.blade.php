@extends('master')
@section('content')
    {!! Form::open(array( 'method'=> 'POST', 'url'=> URL::asset('/').'import/all/loadFile', 'class'=>'form', 'enctype'=>'multipart/form-data')) !!}
    {!! Form::label('classeFile', 'Class.txt:', ['class' => 'control-label']) !!}:
    {!! Form::file('classeFile',['class'=>'form-control']) !!}
    <br>

    {!! Form::label('dateFile', 'Date.txt:', ['class' => 'control-label']) !!}:
    {!! Form::file('dateFile',['class'=>'form-control']) !!}
    <br>

    {!! Form::label('lessonFile', 'Lesson.txt:', ['class' => 'control-label']) !!}:
    {!! Form::file('lessonFile',['class'=>'form-control']) !!}
    <br>

    {!! Form::label('roomFile', 'Room.txt:', ['class' => 'control-label']) !!}:
    {!! Form::file('roomFile',['class'=>'form-control']) !!}
    <br>

    {!! Form::label('subjectFile', 'Subject.txt:', ['class' => 'control-label']) !!}:
    {!! Form::file('subjectFile',['class'=>'form-control']) !!}
    <br>
    {!! Form::label('teacherFile', 'Teacher.txt:', ['class' => 'control-label']) !!}:
    {!! Form::file('teacherFile',['class'=>'form-control']) !!}
    <br>
    {!! Form::label('timeFile', 'Time.txt:', ['class' => 'control-label']) !!}:
    {!! Form::file('timeFile',['class'=>'form-control']) !!}

    {!! Form::submit('Invia',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@stop