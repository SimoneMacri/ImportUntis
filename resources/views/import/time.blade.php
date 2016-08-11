@extends('master')
@section('content')
    {!! Form::open(array( 'method'=> 'POST', 'url'=> URL::asset('/').'import/time/loadFile', 'class'=>'form', 'enctype'=>'multipart/form-data')) !!}
    {!! Form::label('timeFile', 'Time.txt:', ['class' => 'control-label']) !!}<br>
    {!! Form::file('timeFile',['class'=>'form-control']) !!}
        {!! Form::submit('Invia',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@stop