@extends('master')
@section('content')
    {!! Form::open(array( 'method'=> 'POST', 'url'=> URL::asset('/').'import/date/loadFile', 'class'=>'form', 'enctype'=>'multipart/form-data')) !!}
    {!! Form::label('dateFile', 'Date.txt:', ['class' => 'control-label']) !!}<br>
    {!! Form::file('dateFile',['class'=>'form-control']) !!}
        {!! Form::submit('Invia',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@stop