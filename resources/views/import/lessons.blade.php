@extends('master')
@section('content')
    {!! Form::open(array( 'method'=> 'POST', 'url'=> URL::asset('/').'import/lesson/loadFile', 'class'=>'form', 'enctype'=>'multipart/form-data')) !!}
        {!! Form::label('Import Lessons File', 'inserisci il file:', ['class' => 'control-label']) !!}<br>
        {!! Form::file('lessonFile',null,['class'=>'form-control']) !!}
        {!! Form::submit('Invia',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@stop