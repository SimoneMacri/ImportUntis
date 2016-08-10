@extends('master')
@section('content')
    {!! Form::open(array( 'method'=> 'POST', 'url'=> URL::asset('/').'import/teacher/loadFile', 'class'=>'form', 'enctype'=>'multipart/form-data')) !!}
        {!! Form::label('Import Class File', 'inserisci il file:', ['class' => 'control-label']) !!}<br>
        {!! Form::file('teacherFile',null,['class'=>'form-control']) !!}
        {!! Form::submit('Invia',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@stop